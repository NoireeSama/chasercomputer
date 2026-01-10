<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
class PesananController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_pesanan' => 'required|unique:pesanan,kode_pesanan',
            'tanggal_jam' => 'required|date',
            'kategori_id' => 'required|exists:kategori,id',
            'status_id' => 'required|exists:status_pesanan,id',
        ]);
        $pesanan = Pesanan::create($data);
        return response()->json([
            'message' => 'Pesanan berhasil dibuat',
            'data' => $pesanan
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:status_pesanan,id',
        ]);
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($request->only(['status_id']));
        return response()->json([
            'message' => 'Pesanan berhasil diperbarui',
            'data' => $pesanan
        ]);
    }
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();
        return response()->json([
            'message' => 'Pesanan berhasil dihapus'
        ]);
    }
}