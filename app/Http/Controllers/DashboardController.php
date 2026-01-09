<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Pesanan;

class DashboardController extends Controller
{
    public function admin()
    {
        $aktif = Pesanan::where('status_id', '1')->count();
        $dikemas = Pesanan::where('status_id', '2')->count();
        $perjalanan = Pesanan::where('status_id', '3')->count();
        $selesai = Pesanan::where('status_id', '4')->count();
        $pesanan = Pesanan::orderBy('tanggal_jam','desc')->get();

        return view('admin.dashboard', compact(
            'pesanan',
            'aktif',
            'dikemas',
            'perjalanan',
            'selesai'
        ));
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
