<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard');
    }

    public function customer()
    {
        return view('dashboard_cust');
    }
}
