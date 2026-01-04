<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard CC+</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

    <div class="main-container">

        <nav class="glass-panel navbar">
            <div class="logo">Dashboard CC+</div>

            <ul class="nav-links">
                <li><a href="#" class="active">Pesanan</a></li>
                <li><a href="#">Persediaan</a></li>
                <li><a href="#">Garansi aktif</a></li>
                <li><a href="#">Staff</a></li>
                <li><a href="#">Cabang</a></li>
                <li><a href="#">Rakitan</a></li>
            </ul>

            <form method="POST" action="{{ route('logout') }}" class="logout-btn-wrapper">
                @csrf
                <button type="submit" class="glass-pill logout-btn" style="border:none; background:none; padding:0;">
                    Keluar
                </button>
            </form>

        </nav>

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

                <div class="table-row">
                    <div class="col">1</div>
                    <div class="col">CC-000004</div>
                    <div class="col">1-4-2026 20:12</div>
                    <div class="col">Rakit PC</div>
                    <div class="col text-green">Aktif</div>
                    <div class="col wide">Cek Detail Rakitan..</div>
                    <button class="menu-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
                    </button>
                </div>

                <div class="table-row">
                    <div class="col">2</div>
                    <div class="col">CC-000003</div>
                    <div class="col">1-4-2026 13:27</div>
                    <div class="col">Laptop</div>
                    <div class="col text-green">Aktif</div>
                    <div class="col wide">Lenovo LOQ 15 IAX9I</div>
                    <button class="menu-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
                    </button>
                </div>

                <div class="table-row">
                    <div class="col">3</div>
                    <div class="col">CC-000002</div>
                    <div class="col">1-3-2026 10:33</div>
                    <div class="col">Komponen</div>
                    <div class="col text-orange">Dikemas</div>
                    <div class="col wide">Intel Core i3 12100F, Asus H410m</div>
                    <button class="menu-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
                    </button>
                </div>

                <div class="table-row">
                    <div class="col">4</div>
                    <div class="col">CC-000001</div>
                    <div class="col">1-3-2026 07:16</div>
                    <div class="col">Monitor</div>
                    <div class="col text-blue">Dikemas</div>
                    <div class="col wide">Xiaomi G24i</div>
                    <button class="menu-btn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
                    </button>
                </div>

            </div>
        </div>

    </div>

</body>
</html>
