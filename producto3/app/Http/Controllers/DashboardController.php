<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function cliente()
    {
        return view('dashboard.cliente');
    }

    public function hotel()
    {
        return view('dashboard.hotel');
    }

    public function vehiculo()
    {
        return view('dashboard.vehiculo');
    }

    public function admin()
    {
        return view('dashboard.admin');
    }
}

