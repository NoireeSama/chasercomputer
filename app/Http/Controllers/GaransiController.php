<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garansi;

class GaransiController extends Controller
{
    public function index()
    {
        $garansi = Garansi::with('produk')->get();

        return view('admin.garansi', compact('garansi'));
    }
}
