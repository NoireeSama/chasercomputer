@extends('layouts.master')
@section('title', 'Persediaan')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/inventory.css') }}">
@endpush
@section('content')
        <div class="stats-grid" style="margin-top: 20px;">
                <div class="glass-panel stat-card">
            <h3>Total Produk</h3>
            <p class="stat-number text-white">{{ count($persediaan) }}</p>
        </div>
                <div class="glass-panel stat-card">
            <h3>Aman (>10)</h3>
            <p class="stat-number text-green">
                {{ $persediaan->where('stok', '>=', 10)->count() }}
            </p>
        </div>
                <div class="glass-panel stat-card">
            <h3>Sedikit (<10)</h3>
            <p class="stat-number text-orange">
                {{ $persediaan->where('stok', '<', 10)->where('stok', '>', 0)->count() }}
            </p>
        </div>
                <div class="glass-panel stat-card">
            <h3>Habis (0)</h3>
            <p class="stat-number text-red">
                {{ $persediaan->where('stok', 0)->count() }}
            </p>
        </div>
    </div>
    <div class="table-wrapper">
        <div class="table-grid-header">
            <div class="glass-pill header-item">No</div>
            <div class="glass-pill header-item">Kode</div>
            <div class="glass-pill header-item">Nama Produk</div>
            <div class="glass-pill header-item">Kategori</div>
            <div class="glass-pill header-item">Harga</div>
            <div class="glass-pill header-item wide">Stok</div>
        </div>
        <div class="table-content">
            @forelse ($persediaan as $p)
                <div class="table-row">
                    <div class="col center">{{ $loop->iteration }}</div>
                    <div class="col center">{{ $p->produk->kode_produk }}</div>
                    <div class="col wide">{{ $p->produk->nama }}</div>
                    <div class="col center">{{ $p->produk->kategori->nama ?? '-' }}</div>
                                        <div class="col center">
                        Rp {{ number_format($p->produk->harga, 0, ',', '.') }}
                    </div>
                                        <div class="col center font-weight-bold
                        {{ $p->stok == 0 ? 'text-red' : ($p->stok < 10 ? 'text-orange' : 'text-green') }}">
                        {{ $p->stok }}
                    </div>
                    <div class="col center">
                        <button class="icon-btn" title="Lihat Detail"><a href="{{ route('product.detail') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg></a></button>
                    </div>
                </div>
            @empty
                <div class="table-row" style="justify-content: center; padding: 30px; color: #888;">
                    Data persediaan belum tersedia.
                </div>
            @endforelse
        </div>
    </div>
        <button class="fab-add">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="white">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
        </svg>
    </button>
@endsection
