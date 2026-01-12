<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Pesanan;
use App\Models\StatusPesanan;
use App\Models\Kategori;
use App\Models\Role;
use App\Models\Produk;
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

    public function rincianpesanan($pesanan_id)
    {
        $pesanan = Pesanan::with(['kategori', 'status', 'detailPesanan.produk'])->findOrFail($pesanan_id);
        $statuses = StatusPesanan::all();
        $kategoris = Kategori::all();
        return view('admin.branch.rincianpesanan', compact('pesanan', 'statuses', 'kategoris'));
    }

    public function updatePesanan(Request $request, $pesanan_id)
    {
        $pesanan = Pesanan::findOrFail($pesanan_id);

        $request->validate([
            'status_id' => 'required|exists:status_pesanan,id',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        $pesanan->update([
            'status_id' => $request->status_id,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('dashboard.admin')->with('success', 'Pesanan berhasil diperbarui');
    }

    public function customer()
    {
        $produk = Produk::with('gambars')->get();
        $kategori = Kategori::all();
        return view('customer.home', compact('produk', 'kategori'));
    }
    public function staff()
    {
        $staffs = User::with('role')->get();
        return view('admin.staff', compact('staffs'));
    }

    public function editUser($user_id)
    {
        $user = User::with('role')->findOrFail($user_id);
        $roles = Role::all();
        return view('admin.branch.edituser', compact('user', 'roles'));
    }

    public function updateUser(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user_id,
            'email' => 'required|email|unique:users,email,' . $user_id,
            'password' => 'nullable|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        $updateData = [
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('staff')->with('success', 'User berhasil diperbarui');
    }

    public function createUser()
    {
        $roles = Role::all();
        return view('admin.branch.tambahuser', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('staff')->with('success', 'User berhasil ditambahkan');
    }

    public function deleteUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        return redirect()->route('staff')->with('success', 'User berhasil dihapus');
    }

    public function tambahStaff(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
        ]);
        return redirect()->route('staff')->with('success','Staff berhasil ditambahkan');
    }
}
