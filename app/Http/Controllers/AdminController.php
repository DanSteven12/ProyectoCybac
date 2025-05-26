<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Obtener estadísticas básicas
        $stats = [
            'total_services' => Service::count(),
            'total_users' => User::count(),
            'total_roles' => Role::count(),
            'recent_services' => Service::latest()->take(5)->get()
        ];

        return view('admin.dashboard', compact('stats'));
    }
}