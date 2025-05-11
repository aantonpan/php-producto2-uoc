<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admin');
    }
}

