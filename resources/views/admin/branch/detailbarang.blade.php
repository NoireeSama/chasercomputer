@extends('layouts.master')
@section('title', 'Rincian Barang')
@section('hideNavbar')@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/detailbarang.css') }}">
@endpush
@section('content')
    <a href="{{ route('persediaan') }}" class="back-btn">&lt; Kembali</a>
    <div class="product-container">
        <h1>Rincian Barang:</h1>

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

        <form id="productForm" action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Image Grid -->
            <div class="image-grid">
                @for($i=1; $i<=1; $i++)
                    @php $img = $produk->gambars->where('posisi', $i)->first(); @endphp
                    <div class="glass-panel image-box" onclick="document.getElementById('file{{ $i }}').click()">
                        <span class="placeholder-text">+ Foto</span>
                        <input type="file" id="file{{ $i }}" name="gambar{{ $i }}" hidden accept="image/*">
                        @if($img)
                            <img src="{{ asset('storage/' . $img->path) }}" class="img-preview" id="preview{{ $i }}">
                        @else
                            <img src="" class="img-preview" id="preview{{ $i }}" style="display:none">
                        @endif
                    </div>
                @endfor
            </div>

            <div class="form-layout">
                <div class="left-col">
                    <div class="form-group">
                        <label>Jenis</label>
                        <div class="custom-dropdown" id="jenisDropdown">
                            <select name="kategori_id" id="kategoriSelect" class="hidden-select">
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        @if($produk->kategori_id == $kategori->id) selected @endif>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="glass-pill dropdown-btn">
                                <span class="selected-text">{{ $produk->kategori->nama ?? 'Pilih Jenis' }}</span>
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
                    </div>

                    <div class="form-group">
                        <label>ID Barang</label>
                        <div class="glass-pill input-wrapper">
                            <input type="text"
                                   name="kode_produk"
                                   value="{{ $produk->kode_produk }}"
                                   placeholder="Masukkan ID Barang (cth: AUX-005)"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Stok</label>
                        <div class="stock-counter glass-pill">
                            <button type="button" id="btnMinus" class="counter-btn">−</button>
                            <span id="stockValue">{{ $produk->persediaan->stok ?? 0 }}</span>
                            <input type="hidden" name="stok" id="stockInput" value="{{ $produk->persediaan->stok ?? 0 }}">
                            <button type="button" id="btnPlus" class="counter-btn">+</button>
                        </div>
                    </div>

                    <div class="action-group">
                        <button type="submit" class="glass-pill btn-save">Simpan</button>
                        <a href="{{ route('persediaan') }}" class="glass-pill btn-delete" style="text-decoration: none; text-align: center;">Batal</a>
                        <button type="button" class="glass-pill btn-delete" onclick="if(confirm('Apakah Anda yakin ingin menghapus produk ini?')) { document.getElementById('deleteForm').submit(); }">Hapus</button>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="right-col">
                    <div class="form-group">
                        <label>Nama Barang :</label>
                        <div class="glass-pill input-wrapper">
                            <input type="text"
                                   name="nama"
                                   value="{{ $produk->nama }}"
                                   placeholder="Masukkan nama barang..."
                                   required>
                            <svg class="edit-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi barang :</label>
                        <div class="glass-panel textarea-wrapper">
                            <textarea name="deskripsi" placeholder="Tulis deskripsi spesifikasi barang di sini...">{{ $produk->deskripsi }}</textarea>
                            <svg class="edit-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Harga Barang :</label>
                        <div class="glass-pill input-wrapper">
                            <p>Rp. </p>
                            <input type="text"
                                   name="harga"
                                   value="{{ number_format($produk->harga, 0, ',', '.') }}"
                                   id="hargaInput"
                                   placeholder="Masukkan harga barang..."
                                   required>
                            <svg class="edit-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <form id="deleteForm" action="{{ route('produk.delete', $produk->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        const stockValue = document.getElementById('stockValue');
        const stockInput = document.getElementById('stockInput');
        const btnMinus = document.getElementById('btnMinus');
        const btnPlus = document.getElementById('btnPlus');

        btnMinus.addEventListener('click', (e) => {
            e.preventDefault();
            let current = parseInt(stockValue.textContent);
            if (current > 0) {
                current--;
                stockValue.textContent = current;
                stockInput.value = current;
            }
        });

        btnPlus.addEventListener('click', (e) => {
            e.preventDefault();
            let current = parseInt(stockValue.textContent);
            current++;
            stockValue.textContent = current;
            stockInput.value = current;
        });

        for (let i = 1; i <= 4; i++) {
            const fileInput = document.getElementById('file' + i);
            const preview = document.getElementById('preview' + i);

            fileInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

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

        document.addEventListener('click', function(event) {
            if (!event.target.closest('#jenisDropdown')) {
                jenisMenu.classList.remove('active');
            }
        });

        const hargaInput = document.getElementById('hargaInput');

        hargaInput.addEventListener('blur', function() {
            let value = this.value.replace(/\D/g, '');
            if (value) {
                this.value = new Intl.NumberFormat('id-ID').format(value);
            }
        });

        hargaInput.addEventListener('focus', function() {
            this.value = this.value.replace(/\D/g, '');
        });

        document.getElementById('productForm').addEventListener('submit', function(e) {
            const hargaValue = hargaInput.value.replace(/\D/g, '');
            hargaInput.value = hargaValue;
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

        #jenisMenu li {
            cursor: pointer;
            padding: 0.75rem 1rem;
            transition: background 0.3s;
        }

        #jenisMenu li:hover {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
@endsection
