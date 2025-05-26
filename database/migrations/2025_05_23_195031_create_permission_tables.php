<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  // En 2025_05_23_194622_create_permission_tables.php

public function up()
{
    // OMITIR la creación de la tabla 'roles'

    Schema::create('permissions', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name'); // Aquí también podrías cambiar a 'nombre_permiso' si quieres
        $table->string('guard_name');
        $table->timestamps();
    });

    Schema::create('model_has_permissions', function (Blueprint $table) {
        $table->unsignedBigInteger('permission_id');

        $table->string('model_type');
        $table->unsignedBigInteger('model_id');
        $table->index(['model_id', 'model_type']);

        $table->foreign('permission_id')->references('id')->on('permissions')
            ->onDelete('cascade');
    });

    Schema::create('model_has_roles', function (Blueprint $table) {
        $table->unsignedBigInteger('role_id');
        $table->string('model_type');
        $table->unsignedBigInteger('model_id');
        $table->index(['model_id', 'model_type']);

        $table->foreign('role_id')->references('id')->on('roles') // Apunta a tu tabla
            ->onDelete('cascade');
    });

    Schema::create('role_has_permissions', function (Blueprint $table) {
        $table->unsignedBigInteger('permission_id');
        $table->unsignedBigInteger('role_id');

        $table->foreign('permission_id')->references('id')->on('permissions')
            ->onDelete('cascade');

        $table->foreign('role_id')->references('id')->on('roles')
            ->onDelete('cascade');

        $table->primary(['permission_id', 'role_id']);
    });
}

};
