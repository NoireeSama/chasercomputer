<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Chaser Computer</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/barang.css') }}">
</head>
<body>

    <a href="{{ route('home') }}" class="back-btn">&lt; Kembali</a>

    <div class="main-container">

        <div class="product-hero">

            <div class="left-col">
                <div class="glass-panel main-image-box">
                    @php $first = $produk->gambars->first(); @endphp
                    @if($first)
                        <img src="{{ asset('storage/' . $first->path) }}" alt="{{ $produk->nama }}">
                    @else
                        <div class="no-image" style="height:100%; width:100%;"></div>
                    @endif
                </div>

                <form method="POST" action="{{ route('customer.product.buy', urlencode($produk->nama)) }}">
                    @csrf
                    <button type="submit" class="glass-pill buy-btn">Beli</button>
                </form>
            </div>

            <div class="right-col">

                <div class="glass-panel info-box">
                    <h1 class="prod-title">{{ $produk->nama }}</h1>

                    <h2 class="prod-price">Rp {{ number_format($produk->harga,0,',','.') }}</h2>

                    <div class="divider"></div>

                    <p class="prod-desc">
                        {{ $produk->deskripsi }}
                    </p>
                </div>

                <div class="meta-row">
                    <div class="glass-pill meta-label">
                        Stok : {{ $produk->persediaan->stok ?? 0 }}
                    </div>

                    <div class="glass-pill meta-label">
                        {{ $produk->kategori->nama ?? '-' }}
                    </div>
                </div>

            </div>
        </div>

        <div class="recommendation-section">
            <div class="rec-grid">
                @foreach($recommendations as $rec)
                <a href="{{ route('customer.product.show', urlencode($rec->nama)) }}" style="text-decoration:none;color:inherit">
                <div class="glass-panel product-card">
                    <div class="prod-img-box">
                        @php $f = $rec->gambars->first(); @endphp
                        @if($f)
                            <img src="{{ asset('storage/' . $f->path) }}" alt="{{ $rec->nama }}">
                        @else
                            <div class="no-image"></div>
                        @endif
                    </div>
                    <div class="prod-details">
                        <h3>{{ $rec->nama }}</h3>
                        <p class="specs">{{ Str::limit($rec->deskripsi ?? '', 40) }}</p>
                        <p class="price-small">Rp {{ number_format($rec->harga,0,',','.') }}</p>
                    </div>
                </div>
                </a>
                @endforeach
            </div>
        </div>

    </div>
</body>
</html>
