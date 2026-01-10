<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rincian Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/rincianpesan.css') }}">
</head>
<body>
    <a href="{{ route('dashboard.admin') }}" class="back-btn">&lt; Kembali</a>
    <div class="container">
        <h1>Rincian Pesanan:</h1>
        <div class="info-grid">
            <div class="glass-pill label">ID Pesanan</div>
            <div class="glass-pill label">Tanggal & jam</div>
            <div class="glass-pill label">Jenis</div>
            <div class="glass-pill label">Status</div>
            <div class="value-text" id="pesananId">{{ $pesanan->id }}</div>
            <div class="value-text">{{ $pesanan->tanggal_jam }}</div>
            <div class="custom-dropdown" id="jenisDropdown">
                <div class="glass-pill dropdown-btn">
                    <span class="selected-text">{{ $pesanan->kategori->nama ?? '-' }}</span>
                    <span class="arrow">▼</span>
                </div>
                <ul class="dropdown-menu glass-panel">
                    <li data-value="Campuran">Campuran</li>
                    <li data-value="Prebuilt">Prebuilt</li>
                    <li data-value="Rakit PC">Rakit PC</li>
                    <li data-value="Laptop">Laptop</li>
                    <li data-value="Komponen">Komponen Komputer</li>
                </ul>
            </div>
            <div class="custom-dropdown" id="statusDropdown">
                <div class="glass-pill dropdown-btn status-btn" id="statusBtn" style="background: #53A92B; border-color: #53A92B;">
                    <span class="selected-text">{{ $pesanan->status->nama ?? '-' }}</span>
                    <span class="arrow">▼</span>
                </div>
                <ul class="dropdown-menu glass-panel">
                    <li data-value="1" data-color="#53A92B">Aktif</li>
                    <li data-value="2" data-color="#FF693B">Dikemas</li>
                    <li data-value="3" data-color="#6198FF">Dalam Perjalanan</li>
                    <li data-value="4" data-color="#FF2424">Dibatalkan</li>
                </ul>
            </div>
        </div>
        <div class="order-table">
            <div class="table-header">
                <div class="glass-pill col-no">No</div>
                <div class="glass-pill col-item">Isi Pesanan</div>
            </div>
            <div class="table-body" id="itemList">
                @forelse($pesanan->detailPesanan as $i => $detail)
                <div class="table-row">
                    <div class="col-no">{{ $i + 1 }}</div>
                    <div class="col-item">{{ $detail->produk->nama ?? '-' }}</div>
                </div>
                @empty
                <div class="table-row">
                    <div class="col-no">1</div>
                    <div class="col-item">-</div>
                </div>
                @endforelse
            </div>
        </div>
        <div class="action-buttons">
            <button id="btnSimpan" class="glass-pill action-btn btn-save">Simpan</button>
            <button id="btnHapus" class="glass-pill action-btn btn-delete">Hapus</button>
        </div>
    </div>
    <script src="{{ asset('js/rincianpesan.js') }}"></script>
</body>
</html>
