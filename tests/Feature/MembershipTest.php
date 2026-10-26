<?php

namespace Tests\Feature;

use App\Models\Membership;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Database\Seeders\StatusesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MembershipTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected Status $statusActive;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Verificación estricta de seguridad: confirmar que la base de datos es exclusiva de pruebas
        $currentDatabase = config('database.connections.mysql.database');
        if ($currentDatabase !== 'cybac_test') {
            $this->fail("ALERTA DE SEGURIDAD: Conexión apuntando a base de datos insegura: '{$currentDatabase}'. Se esperaba 'cybac_test'.");
        }

        // 2. Poblar catálogos esenciales
        $this->seed(StatusesSeeder::class);
        $this->seed(RoleSeeder::class);

        // 3. Obtener el estado 'Activo' para membresías (type = 1)
        $this->statusActive = Status::where('name', 'Activo')->where('type', 1)->firstOrFail();

        // 4. Crear usuario administrador con el rol correspondiente (slug: 'admin')
        $roleAdmin = Role::where('slug', Role::ADMIN)->firstOrFail();

        $this->admin = User::firstOrCreate(
            ['email' => 'admin.test@cybac.com'],
            [
                'names' => 'Admin',
                'last_name' => 'Tester',
                'birth_date' => '1990-01-01',
                'gender' => 'Otro',
                'password' => bcrypt('password123'),
                'rol_id' => $roleAdmin->id,
                'status_id' => $this->statusActive->id,
            ]
        );
    }

    /**
     * Prueba 1: Validación de membresías con datos inválidos.
     * Verifica que el controlador rechace peticiones que incumplan las reglas reales:
     * - name: requerido
     * - duration: entero >= 1
     * - price: numérico >= 0
     * - status_id: debe existir en statuses
     */
    public function test_rejects_invalid_membership_data(): void
    {
        $invalidData = [
            'name' => '',                // Falla: required
            'description' => 'Prueba',
            'duration' => 0,             // Falla: min:1
            'price' => -15.50,           // Falla: min:0
            'status_id' => 999999,       // Falla: exists:statuses,id
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.memberships.store'), $invalidData);

        // Debe redirigir con errores de validación
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'duration', 'price', 'status_id']);

        // Comprobar que no se haya insertado ningún registro erróneo en MySQL
        $this->assertDatabaseMissing('memberships', [
            'duration' => 0,
        ]);
    }

    /**
     * Prueba 2: Registro exitoso de membresía.
     * Envía una petición POST al controlador real con datos válidos,
     * comprueba la respuesta HTTP y verifica la persistencia en MySQL.
     */
    public function test_admin_can_successfully_register_a_membership(): void
    {
        $validData = [
            'name' => 'Membresía Mensual Pro',
            'description' => 'Acceso ilimitado al gimnasio y a todas las clases durante un mes.',
            'duration' => 30,
            'price' => 45.00,
            'status_id' => $this->statusActive->id,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.memberships.store'), $validData);

        // Debe redirigir al index con mensaje flash de éxito
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.memberships.index'));
        $response->assertSessionHas('success', 'Membresía creada correctamente.');

        // Verificar la persistencia exacta en la base de datos de pruebas (MySQL: cybac_test)
        $this->assertDatabaseHas('memberships', [
            'name' => 'Membresía Mensual Pro',
            'duration' => 30,
            'price' => 45.00,
            'status_id' => $this->statusActive->id,
        ]);
    }

    /**
     * Prueba 3: Consulta del listado administrativo de membresías.
     * Registra una membresía en base de datos, envía un GET al index y
     * valida la respuesta HTTP 200 y la visualización de los datos.
     */
    public function test_admin_can_view_memberships_index_with_registered_membership(): void
    {
        // Registrar membresía directamente en MySQL
        $membership = Membership::create([
            'name' => 'Plan Anual VIP',
            'description' => 'Membresía anual completa con acceso a todas las áreas.',
            'duration' => 365,
            'price' => 350.00,
            'status_id' => $this->statusActive->id,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.memberships.index'));

        // Verificar respuesta HTTP exitosa y vista correcta
        $response->assertStatus(200);
        $response->assertViewIs('admin.memberships.index');

        // Verificar que los datos de la membresía aparezcan en el HTML renderizado
        $response->assertSee('Plan Anual VIP');
        $response->assertSee('350.00');
        $response->assertSee('365 días');
    }
}
