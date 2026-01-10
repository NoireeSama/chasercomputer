@extends('layouts.master')
@section('title', 'Tambah User')
@section('hideNavbar')@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/edituser.css') }}">
@endpush

@section('content')

    {{-- Tombol Kembali --}}
    <a href="{{ route('staff') }}" class="back-btn">&lt; Kembali</a>

    <div class="center-wrapper">
        <div class="form-container">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="addUserForm" action="{{ route('user.store') }}" method="POST">
                @csrf

                {{-- INPUT USERNAME --}}
                <div class="form-group">
                    <label class="form-label">Username :</label>
                    <div class="glass-pill input-wrapper">
                        <input type="text" name="username" placeholder="Masukkan username" required>
                        <svg class="edit-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </div>
                </div>

                {{-- INPUT EMAIL --}}
                <div class="form-group">
                    <label class="form-label">Email :</label>
                    <div class="glass-pill input-wrapper">
                        <input type="email" name="email" placeholder="Masukkan email" required>
                        <svg class="edit-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </div>
                </div>

                {{-- INPUT PASSWORD --}}
                <div class="form-group">
                    <label class="form-label">Password :</label>
                    <div class="glass-pill input-wrapper">
                        <input type="password" name="password" placeholder="Masukkan password" required>
                        <svg class="edit-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </div>
                </div>

                {{-- INPUT PASSWORD CONFIRMATION --}}
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password :</label>
                    <div class="glass-pill input-wrapper">
                        <input type="password" name="password_confirmation" placeholder="Masukkan ulang password" required>
                        <svg class="edit-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </div>
                </div>

                {{-- DROPDOWN ROLE (ADMIN/CUSTOMER) --}}
                <div class="form-group center-content">
                    <label class="form-label">Role :</label>
                    <div class="custom-dropdown" id="roleDropdown">
                        <select name="role_id" id="roleSelect" class="hidden-select">
                            <option value="">Pilih Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->nama }}</option>
                            @endforeach
                        </select>
                        <div class="glass-pill dropdown-btn">
                            <span class="selected-text">Pilih Role</span>
                            <span class="arrow">▼</span>
                        </div>
                        <ul class="dropdown-menu glass-panel" id="roleMenu">
                            @foreach($roles as $role)
                                <li data-value="{{ $role->id }}" data-text="{{ $role->nama }}">
                                    {{ $role->nama }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="action-buttons">
                    <button type="submit" class="glass-pill btn-save">Simpan</button>
                    <a href="{{ route('staff') }}" class="glass-pill btn-delete" style="text-decoration: none; text-align: center;">Batal</a>
                </div>

            </form>

        </div>
    </div>

    <script>
        // Custom dropdown untuk Role
        const roleBtn = document.querySelector('#roleDropdown .dropdown-btn');
        const roleMenu = document.querySelector('#roleMenu');
        const roleSelect = document.getElementById('roleSelect');
        const roleSelected = document.querySelector('#roleDropdown .selected-text');

        roleBtn.addEventListener('click', function() {
            roleMenu.classList.toggle('active');
        });

        document.querySelectorAll('#roleMenu li').forEach(item => {
            item.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const text = this.getAttribute('data-text');
                roleSelect.value = value;
                roleSelected.textContent = text;
                roleMenu.classList.remove('active');
            });
        });

        // Tutup dropdown saat klik di luar
        document.addEventListener('click', function(event) {
            if (!event.target.closest('#roleDropdown')) {
                roleMenu.classList.remove('active');
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

        #roleMenu li {
            cursor: pointer;
            padding: 0.75rem 1rem;
            transition: background 0.3s;
        }

        #roleMenu li:hover {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
@endsection
