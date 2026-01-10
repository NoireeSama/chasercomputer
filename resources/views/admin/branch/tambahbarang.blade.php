@extends('layouts.master')
@section('title', 'Tambah Barang')
@section('hideNavbar')@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/detailbarang.css') }}">
@endpush
@section('content')
    <a href="{{ route('persediaan') }}" class="back-btn">&lt; Kembali</a>
    <div class="product-container">
        <h1>Tambah Barang:</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="productForm" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Image Grid -->
            <div class="image-grid">
                <div class="glass-panel image-box" onclick="document.getElementById('file1').click()">
                    <span class="placeholder-text">+ Foto</span>
                    <input type="file" id="file1" name="gambar1" hidden accept="image/*">
                    <img src="" class="img-preview" id="preview1">
                </div>
                <div class="glass-panel image-box" onclick="document.getElementById('file2').click()">
                    <span class="placeholder-text">+ Foto</span>
                    <input type="file" id="file2" name="gambar2" hidden accept="image/*">
                    <img src="" class="img-preview" id="preview2">
                </div>
                <div class="glass-panel image-box" onclick="document.getElementById('file3').click()">
                    <span class="placeholder-text">+ Foto</span>
                    <input type="file" id="file3" name="gambar3" hidden accept="image/*">
                    <img src="" class="img-preview" id="preview3">
                </div>
                <div class="glass-panel image-box" onclick="document.getElementById('file4').click()">
                    <span class="placeholder-text">+ Foto</span>
                    <input type="file" id="file4" name="gambar4" hidden accept="image/*">
                    <img src="" class="img-preview" id="preview4">
                </div>
            </div>

            <!-- Form Layout -->
            <div class="form-layout">
                <!-- Left Column -->
                <div class="left-col">
                    <div class="form-group">
                        <label>Jenis</label>
                        <div class="custom-dropdown" id="jenisDropdown">
                            <select name="kategori_id" id="kategoriSelect" class="hidden-select">
                                <option value="">Pilih Jenis</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            <div class="glass-pill dropdown-btn">
                                <span class="selected-text">Pilih Jenis</span>
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
                        <label>ID Barang (Prefix)</label>
                        <div class="glass-pill input-wrapper">
                            <input type="text"
                                   name="kode_produk_prefix"
                                   id="prefixInput"
                                   placeholder="Contoh: INT, LAP, CPU (akan jadi INT-001, INT-002, ...)"
                                   required
                                   maxlength="10">
                            <small style="display: block; margin-top: 5px; color: #aaa;">Kode otomatis: <span id="autoCode">-</span></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Stok</label>
                        <div class="stock-counter glass-pill">
                            <button type="button" id="btnMinus" class="counter-btn">−</button>
                            <span id="stockValue">0</span>
                            <input type="hidden" name="stok" id="stockInput" value="0">
                            <button type="button" id="btnPlus" class="counter-btn">+</button>
                        </div>
                    </div>

                    <div class="action-group">
                        <button type="submit" class="glass-pill btn-save">Simpan</button>
                        <a href="{{ route('persediaan') }}" class="glass-pill btn-delete" style="text-decoration: none; text-align: center;">Batal</a>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="right-col">
                    <div class="form-group">
                        <label>Nama Barang :</label>
                        <div class="glass-pill input-wrapper">
                            <input type="text"
                                   name="nama"
                                   placeholder="Masukkan nama barang..."
                                   required>
                            <svg class="edit-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi barang :</label>
                        <div class="glass-panel textarea-wrapper">
                            <textarea name="deskripsi" placeholder="Tulis deskripsi spesifikasi barang di sini..."></textarea>
                            <svg class="edit-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Harga Barang :</label>
                        <div class="glass-pill input-wrapper">
                            <p>Rp. </p>
                            <input type="text"
                                   name="harga"
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

    <script>
        // Stock counter
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

        // Image preview
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

        // Tutup dropdown saat klik di luar
        document.addEventListener('click', function(event) {
            if (!event.target.closest('#jenisDropdown')) {
                jenisMenu.classList.remove('active');
            }
        });

        // Format harga dengan titik pemisah ribuan
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

        // Auto generate kode produk dengan format PREFIX-001, PREFIX-002, dst
        const prefixInput = document.getElementById('prefixInput');
        const autoCodeSpan = document.getElementById('autoCode');

        prefixInput.addEventListener('change', function() {
            const prefix = this.value.toUpperCase().trim();
            if (prefix) {
                autoCodeSpan.textContent = prefix + '-001';
            } else {
                autoCodeSpan.textContent = '-';
            }
        });

        // Form submission - format harga sebelum submit
        document.getElementById('productForm').addEventListener('submit', function(e) {
            const hargaValue = hargaInput.value.replace(/\D/g, '');
            hargaInput.value = hargaValue;

            // Validasi stok
            if (parseInt(stockInput.value) < 0) {
                e.preventDefault();
                alert('Stok tidak boleh negatif');
                return false;
            }
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

        small {
            font-size: 0.85rem;
        }

        #autoCode {
            color: #53A92B;
            font-weight: bold;
        }
    </style>
@endsection
