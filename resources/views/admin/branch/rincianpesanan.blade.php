<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div class="value-text">CC-000004</div>
            <div class="value-text">1-4-2026 20:12</div>
            <div class="custom-dropdown" id="jenisDropdown">
                <div class="glass-pill dropdown-btn">
                    <span class="selected-text">Laptop</span>
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
                <div class="glass-pill dropdown-btn status-btn" style="background: #53A92B; border-color: #53A92B;">
                    <span class="selected-text">Aktif</span>
                    <span class="arrow">▼</span>
                </div>
                <ul class="dropdown-menu glass-panel">
                    <li data-value="Aktif" data-color="#53A92B">Aktif</li>
                    <li data-value="Dikemas" data-color="#FF693B">Dikemas</li>
                    <li data-value="Dalam Perjalanan" data-color="#6198FF">Dalam Perjalanan</li>
                    <li data-value="Dibatalkan" data-color="#FF2424">Dibatalkan</li>
                </ul>
            </div>
        </div>
        <div class="order-table">
            <div class="table-header">
                <div class="glass-pill col-no">No</div>
                <div class="glass-pill col-item">Isi Pesanan</div>
                <button id="addItemBtn" class="add-btn glass-pill">+</button>
            </div>
            <div class="table-body" id="itemList">
                <div class="table-row">
                    <div class="col-no">1</div>
                    <div class="col-item">Lenovo LOQ 15 IAX9I</div>
                    <button class="delete-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#FF2424"><path d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z"/></svg>
                    </button>
                </div>
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
