<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chaser Computer - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

    <div class="main-container">

        <nav class="glass-pill navbar">

            <div class="nav-left">
                <span class="brand-name">Chaser Computer</span>
            </div>

            <div class="divider"></div>

            <div class="nav-center">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" placeholder="Cari barang impianmu..." class="search-input">
            </div>

            <div class="divider"></div>

            <div class="nav-right">
                @guest
                    <a href="{{ route('login') }}" class="nav-btn">Masuk</a>
                    <a href="{{ route('daftar') }}" class="nav-btn btn-highlight">Daftar</a>
                @endguest

                @auth
                    <span class="user-name">{{ Auth::user()->name }}</span> <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="glass-pill logout-btn" style="border:none; width: 100px; height: 40px; cursor: pointer;">Keluar</button>
                    </form>
                @endauth
            </div>
        </nav>

        <div class="glass-panel hero-section">
            <div class="slider-wrapper" id="sliderWrapper">
                <div class="slide">
                    <img src="https://images.unsplash.com/photo-1593640408182-31c70c8268f5?q=80&w=2042&auto=format&fit=crop" alt="Promo 1">
                    <div class="slide-caption">
                        <h2>Rakitan Sultan</h2>
                        <p>Diskon hingga 20% untuk paket fullset!</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?q=80&w=2000&auto=format&fit=crop" alt="Promo 2">
                     <div class="slide-caption">
                        <h2>Laptop Gaming</h2>
                        <p>Performa gahar, harga pelajar.</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?q=80&w=2070&auto=format&fit=crop" alt="Promo 3">
                     <div class="slide-caption">
                        <h2>Aksesoris Lengkap</h2>
                        <p>Upgrade setup-mu sekarang juga.</p>
                    </div>
                </div>
            </div>

            <div class="slider-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>

        <div class="category-scroll">
            <button class="glass-pill cat-btn active" data-kategori="all" onclick="filterByCategory('all', event)">Semua</button>
            @forelse($kategori as $kat)
                <button class="glass-pill cat-btn" data-kategori="{{ $kat->id }}" onclick="filterByCategory({{ $kat->id }}, event)">{{ $kat->nama }}</button>
            @empty
                <!-- Jika tidak ada kategori -->
            @endforelse
        </div>

        <div class="product-grid" id="productContainer">
            @forelse($produk as $item)
                <a href="{{ route('customer.product.show', urlencode($item->nama)) }}" style="text-decoration:none; color:inherit;">
                <div class="glass-panel product-card" data-kategori="{{ $item->kategori_id }}">
                    <div class="prod-img-box">
                        @php $first = $item->gambars->first(); @endphp
                        @if($first)
                            <img src="{{ asset('storage/' . $first->path) }}" alt="{{ $item->nama }}" onerror="this.style.display='none'">
                        @else
                            <div class="no-image"></div>
                        @endif
                    </div>
                    <div class="prod-details">
                        <h3>{{ $item->nama }}</h3>
                        <p class="specs">{{ $item->deskripsi }}</p>
                        <p class="price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
                </a>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #ccc;">
                    <p>Tidak ada produk yang ditemukan.</p>
                </div>
            @endforelse
        </div>

    </div>

    <script src="{{ asset('js/home.js') }}"></script>
    <script>
        function filterByCategory(kategoriId, event) {
            event.preventDefault();

            // Update active button
            document.querySelectorAll('.cat-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Fetch produk berdasarkan kategori
            const url = kategoriId === 'all'
                ? '{{ route("home") }}'
                : '{{ route("home") }}?kategori_id=' + kategoriId;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('productContainer');

                if (data.produk.length === 0) {
                    container.innerHTML = '<div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #ccc;"><p>Tidak ada produk yang ditemukan.</p></div>';
                    return;
                }

                container.innerHTML = data.produk.map(item => {
                    const gambar = item.gambar_utama
                        ? `{{ asset('storage') }}/${item.gambar_utama}`
                        : null;

                    const desc = item.deskripsi || '';
                    const descDisplay = desc; // CSS will handle truncation via multiline clamp
                    const harga = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(item.harga);

                    return `
                        <a href="/barang/${encodeURIComponent(item.nama)}" style="text-decoration:none; color:inherit;">
                        <div class="glass-panel product-card" data-kategori="${item.kategori_id}">
                            <div class="prod-img-box">
                                ${gambar ? `<img src="${gambar}" alt="${item.nama}" onerror="this.style.display='none'">` : `<div class="no-image"></div>`}
                            </div>
                            <div class="prod-details">
                                <h3>${item.nama}</h3>
                                <p class="specs">${descDisplay}</p>
                                <p class="price">${harga}</p>
                            </div>
                        </div>
                        </a>
                    `;
                }).join('');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat data');
            });
        }
    </script>
</body>
</html>
