@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<div class="stats-grid">
    <div class="glass-panel stat-card">
        <h3>Jumlah Pesanan aktif</h3>
        <p class="stat-number text-green">1</p>
    </div>

    <div class="glass-panel stat-card">
        <h3>Dikemas</h3>
        <p class="stat-number text-orange">2</p>
    </div>

    <div class="glass-panel stat-card">
        <h3>Dalam Perjalanan</h3>
        <p class="stat-number text-blue">0</p>
    </div>

    <div class="glass-panel stat-card">
        <h3>Selesai</h3>
        <p class="stat-number text-white">20</p>
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
    </div>
</div>

@endsection
