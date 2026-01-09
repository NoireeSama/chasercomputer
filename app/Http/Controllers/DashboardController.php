<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function customer()
    {
        return view('dashboard_cust');
    }

    public function staff()
    {
        $staffs = User::with('role')
            ->whereHas('role', fn($q) => $q->where('nama','admin'))
            ->get();

        return view('admin.staff', compact('staffs'));
    }

    public function tambahStaff(Request $request)
    {   User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
        ]);
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);



        return redirect()->route('staff')->with('success','Staff berhasil ditambahkan');
    }
}
