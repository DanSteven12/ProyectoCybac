<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $fillable = ['name', 'guard_name'];

    public const USUARIO = 'usuario';
    public const ADMIN = 'admin';
    public const INSTRUCTOR = 'instructor';


}
