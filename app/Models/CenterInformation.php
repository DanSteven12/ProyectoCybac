<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterInformation extends Model
{
    // Si tu tabla se llama 'center_information'
    protected $table = 'center_information';

    protected $fillable = [
        'schedule',     // horarios
        'phone',         // teléfono
        'email',         // correo
        'address',       // dirección
    ];
}