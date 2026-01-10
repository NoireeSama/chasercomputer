@extends('layouts.master')
@section('title', 'Staff')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/staff.css') }}">
@endpush
@section('content')

    <h1>Daftar User</h1>

    <div class="table-wrapper">
        <div class="table-grid-header">
            <div class="glass-pill header-item">No</div>
            <div class="glass-pill header-item">User</div>
            <div class="glass-pill header-item wide">Role</div>
        </div>
        <div class="table-content">
            @forelse ($staffs as $i => $staff)
                <div class="table-row">
                    <div class="col center">{{ $loop->iteration }}</div>
                    <div class="col center">{{ $staff->username }}</div>
                    <div class="col wide">{{ $staff->role->nama ?? '-' }}</div>
                    <div class="col center">
                        <button class="icon-btn" title="Lihat Detail"><a href="{{ route('edit.user', $staff->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg></a></button>
                    </div>
                </div>
            @empty
                <div class="table-row" style="justify-content: center; padding: 30px; color: #888;">
                    Data staff belum tersedia.
                </div>
            @endforelse
        </div>
    </div>
    <button class="fab-add">
        <a href="{{ route('tambah.user') }}">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="white">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
            </svg>
        </a>

    </button>
@endsection
