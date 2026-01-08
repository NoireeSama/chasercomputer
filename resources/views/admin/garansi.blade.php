@extends('layouts.master')

@section('title', 'Persediaan')

@section('content')
    <h1 class="text-white text-2xl mb-4">Halaman Garansi</h1>
    <div class="container">
    <h4>Garansi Aktif</h4>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Nomor Seri</th>
                <th>Mulai</th>
                <th>Berakhir</th>
                <th>Sisa Hari</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($garansi as $i => $g)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $g->produk->nama }}</td>
                <td>{{ $g->nomor_seri ?? '-' }}</td>
                <td>{{ $g->tanggal_mulai }}</td>
                <td>{{ $g->tanggal_berakhir }}</td>
                <td>{{ now()->diffInDays($g->tanggal_berakhir, false) }}</td>
                <td>
                    <span class="badge bg-success">Aktif</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
