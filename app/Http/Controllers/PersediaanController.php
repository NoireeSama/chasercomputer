<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Persediaan;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\ProdukGambar;
use Illuminate\Support\Facades\Storage;

class PersediaanController extends Controller
{
    public function index()
    {
        $persediaan = Persediaan::with('produk.kategori','produk.gambars')->get();
        return view('admin.persediaan', compact('persediaan'));
    }

    public function detailProduk($produk_id)
    {
        $produk = Produk::with(['kategori', 'persediaan','gambars'])->findOrFail($produk_id);
        $kategoris = Kategori::all();
        return view('admin.branch.detailbarang', compact('produk', 'kategoris'));
    }

    public function updateProduk(Request $request, $produk_id)
    {
        $produk = Produk::findOrFail($produk_id);
        $persediaan = Persediaan::where('produk_id', $produk_id)->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'kode_produk' => 'required|string|max:50|unique:produk,kode_produk,' . $produk_id,
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
        ]);

        $produk->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'kode_produk' => $request->kode_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        $persediaan->update([
            'stok' => $request->stok,
        ]);

        for ($i = 1; $i <= 4; $i++) {
            $field = 'gambar' . $i;
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store('produk', 'public');

                $existing = ProdukGambar::where('produk_id', $produk->id)->where('posisi', $i)->first();
                if ($existing) {
                    if ($existing->path) {
                        Storage::disk('public')->delete($existing->path);
                    }
                    $existing->update(['path' => $path]);
                } else {
                    ProdukGambar::create([
                        'produk_id' => $produk->id,
                        'path' => $path,
                        'posisi' => $i,
                    ]);
                }
            }
        }
        return redirect()->route('persediaan')->with('success', 'Produk berhasil diperbarui');
    }

    public function createProduk()
    {
        $kategoris = Kategori::all();
        return view('admin.branch.tambahbarang', compact('kategoris'));
    }

    public function storeProduk(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'kode_produk_prefix' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
        ]);

        $prefix = $request->kode_produk_prefix;

        $lastProduk = Produk::where('kode_produk', 'LIKE', $prefix . '-%')
            ->orderBy('kode_produk', 'DESC')
            ->first();

        if ($lastProduk) {
            $lastCode = $lastProduk->kode_produk;
            preg_match('/(\d+)$/', $lastCode, $matches);
            $lastNumber = isset($matches[1]) ? intval($matches[1]) : 0;
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $kodeProduk = $prefix . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $harga = str_replace(['.', ','], '', $request->harga);

        $produk = Produk::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'kode_produk' => $kodeProduk,
            'harga' => $harga,
            'deskripsi' => $request->deskripsi,
        ]);

        for ($i = 1; $i <= 4; $i++) {
            $field = 'gambar' . $i;
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store('produk', 'public');
                ProdukGambar::create([
                    'produk_id' => $produk->id,
                    'path' => $path,
                    'posisi' => $i,
                ]);
            }
        }
        Persediaan::create([
            'produk_id' => $produk->id,
            'stok' => $request->stok,
        ]);

        return redirect()->route('persediaan')->with('success', 'Produk berhasil ditambahkan dengan kode: ' . $kodeProduk);
    }

    public function deleteProduk($produk_id)
    {
        $produk = Produk::findOrFail($produk_id);
        $persediaan = Persediaan::where('produk_id', $produk_id)->first();

        if ($persediaan) {
            $persediaan->delete();
        }

        $gambars = ProdukGambar::where('produk_id', $produk->id)->get();
        foreach ($gambars as $g) {
            if ($g->path) {
                Storage::disk('public')->delete($g->path);
            }
            $g->delete();
        }

        $produk->delete();

        return redirect()->route('persediaan')->with('success', 'Produk berhasil dihapus');
    }
}
