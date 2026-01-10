@extends('layouts.master')
@section('title', 'Rincian Barang')
@section('hideNavbar')@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/detailbarang.css') }}">
@endpush
@section('content')
        <a href="{{ route('persediaan') }}" class="back-btn">&lt; Kembali</a>
    <div class="product-container">
        <h1>Tambah Barang:</h1>
        <form id="productForm">
                        <div class="image-grid">
                <div class="glass-panel image-box" onclick="document.getElementById('file1').click()">
                    <span class="placeholder-text">+ Foto</span>
                    <input type="file" id="file1" hidden>
                    <img src="" class="img-preview" id="preview1">
                </div>
                <div class="glass-panel image-box" onclick="document.getElementById('file2').click()">
                    <span class="placeholder-text">+ Foto</span>
                    <input type="file" id="file2" hidden>
                    <img src="" class="img-preview" id="preview2">
                </div>
                <div class="glass-panel image-box" onclick="document.getElementById('file3').click()">
                    <span class="placeholder-text">+ Foto</span>
                    <input type="file" id="file3" hidden>
                    <img src="" class="img-preview" id="preview3">
                </div>
                <div class="glass-panel image-box" onclick="document.getElementById('file4').click()">
                    <span class="placeholder-text">+ Foto</span>
                    <input type="file" id="file4" hidden>
                    <img src="" class="img-preview" id="preview4">
                </div>
            </div>
                        <div class="form-layout">
                                <div class="left-col">
                    <div class="form-group">
                        <label>Jenis</label>
                        <div class="custom-dropdown" id="jenisDropdown">
                            <div class="glass-pill dropdown-btn">
                                <span class="selected-text">Laptop</span>
                                <span class="arrow">▼</span>
                            </div>
                            <ul class="dropdown-menu glass-panel">
                                <li>Laptop</li>
                                <li>Processor (CPU)</li>
                                <li>VGA Card</li>
                                <li>Motherboard</li>
                                <li>RAM</li>
                                <li>Monitor</li>
                                <li>Storage (SSD/HDD)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>ID Barang</label>
                        <div class="glass-pill input-wrapper">
                            <input type="text" name="kode_produk" placeholder="Masukkan ID Barang (cth: 005)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Stok</label>
                        <div class="stock-counter glass-pill">
                            <button type="button" id="btnMinus" class="counter-btn">−</button>
                            <span id="stockValue">2</span>
                            <button type="button" id="btnPlus" class="counter-btn">+</button>
                        </div>
                    </div>
                    <div class="action-group">
                        <button type="button" id="btnSimpan" class="glass-pill btn-save">Simpan</button>
                        <button type="button" id="btnHapus" class="glass-pill btn-delete">Hapus</button>
                    </div>
                </div>
                                <div class="right-col">
                    <div class="form-group">
                        <label>Nama Barang :</label>
                        <div class="glass-pill input-wrapper">
                            <input type="text" value="Lenovo LOQ 15 IAX9i" placeholder="Masukkan nama barang...">
                            <svg class="edit-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi barang :</label>
                        <div class="glass-panel textarea-wrapper">
                            <textarea placeholder="Tulis deskripsi spesifikasi barang di sini...">Intel Core i5-12450HX, RTX 2050 4GB, RAM 12GB, SSD 512GB, 144Hz Display.</textarea>
                            <svg class="edit-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Harga Barang :</label>
                        <div class="glass-pill input-wrapper">
                            <p>Rp. </p><input type="text" value=" 12.000.000" placeholder="Masukkan harga barang...">
                            <svg class="edit-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/detailbarang.js') }}"></script>
@endsection
