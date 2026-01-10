<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Persediaan;
class PersediaanController extends Controller
{
    public function index()
    {
        $persediaan = Persediaan::with('produk.kategori')->get();
        return view('admin.persediaan', compact('persediaan'));
    }
}