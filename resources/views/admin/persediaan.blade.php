@extends('layouts.master')

@section('title', 'Persediaan')

@section('content')
    <h1 class="text-white text-2xl mb-4">Halaman Persediaan</h1>
    <div class="container">
        <h4>Data Persediaan</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($persediaan as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $p->produk->kode_produk }}</td>
                        <td>{{ $p->produk->nama }}</td>
                        <td>{{ $p->produk->kategori->nama ?? '-' }}</td>
                        <td>Rp {{ number_format($p->produk->harga, 0, ',', '.') }}</td>
                        <td>{{ $p->stok }}</td>
                        <td>{{ $p->produk->deskripsi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
