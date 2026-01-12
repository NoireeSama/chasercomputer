@extends('layouts.master')
@section('title', 'Persediaan')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/garansi.css') }}">
@endpush
@section('content')
    <h1 class="text-white text-2xl mb-4">Halaman Garansi</h1>
    <div class="table-wrapper">
        <div class="table-grid-header">
            <div class="glass-pill header-item">No</div>
            <div class="glass-pill header-item">Produk</div>
            <div class="glass-pill header-item">Nomor Seri</div>
            <div class="glass-pill header-item">Mulai</div>
            <div class="glass-pill header-item">Sisa Hari</div>
            <div class="glass-pill header-item">Status</div>
        </div>
        <div class="table-content">
            @forelse ($garansi as $i => $g)
                <div class="table-row">
                    <div class="col center">{{ $loop->iteration }}</div>
                    <div class="col center">{{ $g->produk->nama }}</div>
                    <div class="col wide">{{ $g->nomor_seri ?? '-' }}</div>
                    <div class="col center">{{ $g->tanggal_mulai }}</div>
                    <div class="col center">
                        {{ number_format(max(0, now()->diffInHours($g->tanggal_berakhir, false) / 24), 0) }} hari
                    </div>
                    <div class="col center">
                        <span class="badge bg-success text-{{ $g->statusGaransi->warna }}">{{ $g->statusGaransi->nama }}</span>
                    </div>
                </div>
            @empty
                <div class="table-row" style="justify-content: center; padding: 30px; color: #888;">
                    Data garansi belum tersedia.
                </div>
            @endforelse
        </div>
    </div>
@endsection
