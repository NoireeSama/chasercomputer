<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori yang dipilih dari query parameter
        $kategoriId = $request->query('kategori_id');

        // Query produk berdasarkan kategori jika ada filter
        $query = Produk::query();

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        $produk = $query->with('gambars')->get();

        // Ambil semua kategori untuk ditampilkan di filter
        $kategori = Kategori::all();

        // Jika request adalah AJAX, return JSON
        if ($request->ajax()) {
            // Transform produk for JSON: include first image path as gambar_utama
            $data = $produk->map(function($p) {
                return [
                    'id' => $p->id,
                    'nama' => $p->nama,
                    'kategori_id' => $p->kategori_id,
                    'deskripsi' => $p->deskripsi,
                    'harga' => $p->harga,
                    'gambar_utama' => optional($p->gambars->first())->path,
                ];
            });

            return response()->json([
                'produk' => $data,
            ]);
        }

        // Return view dengan data
        return view('customer.home', compact('produk', 'kategori'));
    }
}
