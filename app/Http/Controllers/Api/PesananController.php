<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:status_pesanan,id',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($request->only(['status_id','kategori_id']));

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
