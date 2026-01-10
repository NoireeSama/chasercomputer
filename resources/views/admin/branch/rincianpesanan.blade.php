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

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form id="formPesanan" action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
            @csrf
            <div class="info-grid">
                <div class="glass-pill label">ID Pesanan</div>
                <div class="glass-pill label">Tanggal & jam</div>
                <div class="glass-pill label">Jenis</div>
                <div class="glass-pill label">Status</div>

                <div class="value-text">{{ $pesanan->kode_pesanan }}</div>
                <div class="value-text">{{ \Carbon\Carbon::parse($pesanan->tanggal_jam)->format('d-m-Y H:i') }}</div>

                <div class="custom-dropdown" id="jenisDropdown">
                    <select name="kategori_id" id="kategoriSelect" class="hidden-select">
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                @if($pesanan->kategori_id == $kategori->id) selected @endif>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    <div class="glass-pill dropdown-btn">
                        <span class="selected-text">{{ $pesanan->kategori->nama ?? 'Pilih Jenis' }}</span>
                        <span class="arrow">▼</span>
                    </div>
                    <ul class="dropdown-menu glass-panel" id="jenisMenu">
                        @foreach($kategoris as $kategori)
                            <li data-value="{{ $kategori->id }}" data-text="{{ $kategori->nama }}">
                                {{ $kategori->nama }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="custom-dropdown" id="statusDropdown">
                    <select name="status_id" id="statusSelect" class="hidden-select">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}"
                                @if($pesanan->status_id == $status->id) selected @endif>
                                {{ $status->nama }}
                            </option>
                        @endforeach
                    </select>
                    <div class="glass-pill dropdown-btn status-btn"
                         style="background: {{ $pesanan->status->warna ?? '#53A92B' }}; border-color: {{ $pesanan->status->warna ?? '#53A92B' }};">
                        <span class="selected-text">{{ $pesanan->status->nama ?? 'Pilih Status' }}</span>
                        <span class="arrow">▼</span>
                    </div>
                    <ul class="dropdown-menu glass-panel" id="statusMenu">
                        @foreach($statuses as $status)
                            <li data-value="{{ $status->id }}" data-text="{{ $status->nama }}" data-color="{{ $status->warna ?? '#53A92B' }}">
                                {{ $status->nama }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="order-table">
                <div class="table-header">
                    <div class="glass-pill col-no">No</div>
                    <div class="glass-pill col-item">Isi Pesanan</div>
                </div>
                <div class="table-body" id="itemList">
                    @forelse($pesanan->detailPesanan as $index => $detail)
                        <div class="table-row">
                            <div class="col-no">{{ $index + 1 }}</div>
                            <div class="col-item">{{ $detail->produk->nama ?? '-' }}</div>
                        </div>
                    @empty
                        <div class="table-row">
                            <div class="col-no">-</div>
                            <div class="col-item">Tidak ada item pesanan</div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="action-buttons">
                <button type="submit" class="glass-pill action-btn btn-save">Simpan</button>
                <a href="{{ route('dashboard.admin') }}" class="glass-pill action-btn btn-delete" style="text-decoration: none; text-align: center;">Batal</a>
            </div>
        </form>
    </div>

    <script>
        // Custom dropdown untuk Jenis
        const jenisBtn = document.querySelector('#jenisDropdown .dropdown-btn');
        const jenisMenu = document.querySelector('#jenisMenu');
        const kategoriSelect = document.getElementById('kategoriSelect');
        const jenisSelected = document.querySelector('#jenisDropdown .selected-text');

        jenisBtn.addEventListener('click', function() {
            jenisMenu.classList.toggle('active');
        });

        document.querySelectorAll('#jenisMenu li').forEach(item => {
            item.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const text = this.getAttribute('data-text');
                kategoriSelect.value = value;
                jenisSelected.textContent = text;
                jenisMenu.classList.remove('active');
            });
        });

        // Custom dropdown untuk Status
        const statusBtn = document.querySelector('#statusDropdown .dropdown-btn');
        const statusMenu = document.querySelector('#statusMenu');
        const statusSelect = document.getElementById('statusSelect');
        const statusSelected = document.querySelector('#statusDropdown .selected-text');

        statusBtn.addEventListener('click', function() {
            statusMenu.classList.toggle('active');
        });

        document.querySelectorAll('#statusMenu li').forEach(item => {
            item.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const text = this.getAttribute('data-text');
                const color = this.getAttribute('data-color');
                statusSelect.value = value;
                statusSelected.textContent = text;
                statusBtn.style.background = color;
                statusBtn.style.borderColor = color;
                statusMenu.classList.remove('active');
            });
        });

        // Tutup dropdown saat klik di luar
        document.addEventListener('click', function(event) {
            if (!event.target.closest('#jenisDropdown')) {
                jenisMenu.classList.remove('active');
            }
            if (!event.target.closest('#statusDropdown')) {
                statusMenu.classList.remove('active');
            }
        });

        // Form submission
        document.getElementById('formPesanan').addEventListener('submit', function(e) {
            e.preventDefault();
            this.submit();
        });
    </script>

    <style>
        .hidden-select {
            display: none;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
        }

        .alert-danger {
            background-color: #ffe0e0;
            color: #c00;
            border: 1px solid #ff9999;
        }

        .alert-success {
            background-color: #e0ffe0;
            color: #060;
            border: 1px solid #99ff99;
        }

        .alert ul {
            margin: 0;
            padding-left: 1.5rem;
        }

        .dropdown-menu.active {
            display: block !important;
        }

        #statusMenu li,
        #jenisMenu li {
            cursor: pointer;
            padding: 0.75rem 1rem;
            transition: background 0.3s;
        }

        #statusMenu li:hover,
        #jenisMenu li:hover {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
</body>
</html>
