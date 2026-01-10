@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<h1>Halo {{ auth()->user()->username }}, kamu adalah  {{ auth()->user()->role->nama }}</h1> <br>
<div class="stats-grid">
    <div class="glass-panel stat-card">
        <h3>Jumlah Pesanan aktif</h3>
        <p class="stat-number text-green">{{ $aktif }}</p>
    </div>
    <div class="glass-panel stat-card">
        <h3>Dikemas</h3>
        <p class="stat-number text-orange">{{ $dikemas }}</p>
    </div>
    <div class="glass-panel stat-card">
        <h3>Dalam Perjalanan</h3>
        <p class="stat-number text-blue">{{ $perjalanan }}</p>
    </div>
    <div class="glass-panel stat-card">
        <h3>Selesai</h3>
        <p class="stat-number text-white">{{ $selesai }}</p>
    </div>
</div>
<div class="table-wrapper">
    <div class="table-grid-header">
        <div class="glass-pill header-item">No</div>
        <div class="glass-pill header-item">ID Pesanan</div>
        <div class="glass-pill header-item">Tanggal & jam</div>
        <div class="glass-pill header-item">Jenis</div>
        <div class="glass-pill header-item">Status</div>
        <div class="glass-pill header-item wide">Isi Pesanan</div>
    </div>
    <div class="table-content">
        @foreach ($pesanan as $i => $p)
        <div class="table-row">
            <div class="col">{{ $i+1 }}</div>
            <div class="col">{{ $p->kode_pesanan }}</div>
            <div class="col">{{ $p->tanggal_jam }}</div>
            <div class="col">{{ $p->kategori->nama ?? '-' }}</div>
            <div class="col text-{{ $p->status->warna }}">{{ $p->status->nama ?? '-' }}</div>
            <div class="col wide">
                {{ $p->detailPesanan->first()->produk->nama ?? '-' }}
            </div>
            <button class="menu-btn">
                <a href="{{ route('rincianpesanan') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                </a>
            </button>
        </div>
        @endforeach
        @if($pesanan->isEmpty())
            <div class="text-center text-gray-400 p-6">Belum ada pesanan</div>
        @endif
    </div>
@endsection
