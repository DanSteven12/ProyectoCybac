<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'names',
        'last_name',
        'birth_date',
        'gender',
        'email',
        'password',
        'status_id',
        'specialty',
        'certification',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relación con el modelo de estado
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id')->withDefault([
            'name' => 'Undefined Status',
        ]);
    }

    // RELACIÓN: Un usuario tiene muchos pagos
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'user_id');
    }

}
