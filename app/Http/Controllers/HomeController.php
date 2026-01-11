<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $kategoriId = $request->query('kategori_id');

        $query = Produk::query();

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        $produk = $query->with('gambars')->get();

        $kategori = Kategori::all();

        if ($request->ajax()) {
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


        return view('customer.home', compact('produk', 'kategori'));
    }

    public function showProduct($slug)
    {
        $name = urldecode($slug);
        $produk = Produk::with(['gambars', 'kategori', 'persediaan'])->where('nama', $name)->firstOrFail();
        $recommendations = Produk::where('id', '<>', $produk->id)->inRandomOrder()->limit(5)->get();
        return view('customer.barang', compact('produk', 'recommendations'));
    }

    public function buyProduct(Request $request, $slug)
    {
        $name = urldecode($slug);
        $produk = Produk::with('kategori')->where('nama', $name)->firstOrFail();

        $kode = 'P-' . time();
        $pesanan = \App\Models\Pesanan::create([
            'kode_pesanan' => $kode,
            'tanggal_jam' => now(),
            'kategori_id' => $produk->kategori_id,
            'status_id' => 1,
        ]);

        \App\Models\DetailPesanan::create([
            'pesanan_id' => $pesanan->id,
            'produk_id' => $produk->id,
            'jumlah' => 1,
        ]);

        return redirect()->back()->with('success', 'Pesanan dibuat (kode: ' . $kode . ')');
    }
}
