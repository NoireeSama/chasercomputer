@extends('layouts.master')
@section('title', 'Edit User')
@section('hideNavbar')@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/edituser.css') }}">
@endpush

@section('content')

    {{-- Tombol Kembali --}}
    <a href="{{ route('staff') }}" class="back-btn">&lt; Kembali</a>

    <div class="center-wrapper">
        <div class="form-container">

            <form id="editUserForm">

                {{-- INPUT NAMA USER --}}
                <div class="form-group">
                    <label class="form-label">Nickname User :</label>
                    <div class="glass-pill input-wrapper">
                        <input type="text" id="userName" value="Zaydan Azka" placeholder="Nama User">
                        <svg class="edit-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama User :</label>
                    <div class="glass-pill input-wrapper">
                        <input type="text" id="userName" value="Zaydan Azka" placeholder="Nama User">
                        <svg class="edit-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Password User :</label>
                    <div class="glass-pill input-wrapper">
                        <input type="password" id="userName" value="Walawe" placeholder="Nama User">
                        <svg class="edit-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </div>
                </div>

                {{-- DROPDOWN ROLE (ADMIN/CUSTOMER) --}}
                <div class="form-group center-content">
                    <div class="custom-dropdown" id="roleDropdown">
                        <div class="glass-pill dropdown-btn">
                            <span class="selected-text">Admin</span>
                            <span class="arrow">▼</span>
                        </div>
                        <ul class="dropdown-menu glass-panel">
                            <li data-value="Admin">Admin</li>
                            <li data-value="Customer">Customer</li>
                        </ul>
                        <input type="hidden" name="role" id="roleInput" value="Admin">
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="action-buttons">
                    <button type="button" id="btnSimpan" class="glass-pill btn-save">Simpan</button>
                    <button type="button" id="btnHapus" class="glass-pill btn-delete">Hapus</button>
                </div>

            </form>

        </div>
    </div>

    <script src="{{ asset('js/edituser.js') }}"></script>
@endsection
