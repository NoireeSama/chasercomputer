@extends('layouts.master')
@section('title', 'Staff')
@section('content')
    <h1>Tambah Staff Admin</h1>
    @if ($errors->any())
        <div style="background:#fee;color:#900;padding:10px;border-radius:6px;margin-bottom:10px">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('staff.tambah') }}" method="POST">
        @csrf
        <tr>
            <td><input type="text" name="username" placeholder="Username" required></td>
        </tr>
        <tr>
            <td><input type="text" name="email" placeholder="Email" required></td>
        </tr>
        <tr>
            <td><input type="password" name="password" placeholder="password" required></td>
        </tr>
        <tr>
            <td><input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required></td>
        </tr>
        <tr>
            <td><button>Tambah</button></td>
        </tr>
    </form>
    <h2>Daftar Staff Admin</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($staffs as $i => $staff)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $staff->username }}</td>
                    <td>{{ $staff->role->nama }}</td>
                </tr>
            @empty
                <tr>
                    <td>
                        Belum ada staff admin
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
