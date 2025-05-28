<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Tu lógica para mostrar el dashboard admin
        return view('admin.dashboard');
    }
}
