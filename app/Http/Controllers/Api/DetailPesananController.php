<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPesanan;
class DetailPesananController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'pesanan_id' => 'required|exists:pesanan,id',
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);
        $detail = DetailPesanan::create($data);
        return response()->json([
            'message' => 'Detail pesanan berhasil ditambahkan',
            'data' => $detail
        ], 201);
    }
}