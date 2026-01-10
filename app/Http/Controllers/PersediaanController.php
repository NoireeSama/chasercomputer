<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Persediaan;
use App\Models\Produk;
use App\Models\Kategori;

class PersediaanController extends Controller
{
    public function index()
    {
        $persediaan = Persediaan::with('produk.kategori')->get();
        return view('admin.persediaan', compact('persediaan'));
    }

    public function detailProduk($produk_id)
    {
        $produk = Produk::with(['kategori', 'persediaan'])->findOrFail($produk_id);
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

        // Update produk
        $produk->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'kode_produk' => $request->kode_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        // Update stok
        $persediaan->update([
            'stok' => $request->stok,
        ]);

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

        // Generate kode produk otomatis dengan auto-increment
        $prefix = $request->kode_produk_prefix;

        // Cari produk dengan prefix yang sama
        $lastProduk = Produk::where('kode_produk', 'LIKE', $prefix . '-%')
            ->orderBy('kode_produk', 'DESC')
            ->first();

        if ($lastProduk) {
            // Extract angka dari kode terakhir
            $lastCode = $lastProduk->kode_produk;
            preg_match('/(\d+)$/', $lastCode, $matches);
            $lastNumber = isset($matches[1]) ? intval($matches[1]) : 0;
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // Generate kode produk dengan format PREFIX-NNN (3 digit)
        $kodeProduk = $prefix . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Hapus format harga jika ada
        $harga = str_replace(['.', ','], '', $request->harga);

        // Create produk
        $produk = Produk::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'kode_produk' => $kodeProduk,
            'harga' => $harga,
            'deskripsi' => $request->deskripsi,
        ]);

        // Create persediaan
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

        // Hapus persediaan terlebih dahulu
        if ($persediaan) {
            $persediaan->delete();
        }

        // Hapus produk
        $produk->delete();

        return redirect()->route('persediaan')->with('success', 'Produk berhasil dihapus');
    }
}
