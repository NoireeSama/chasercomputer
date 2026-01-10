@extends('layouts.master')
@section('title', 'Tambah Persediaan')
@section('content')
    <h2>Tambah Persediaan</h2>
    @include('admin.persediaan._form', [
        'action' => route('persediaan.store'),
        'method' => 'POST',
        'persediaan' => null,
        'produks' => $produks
    ])
@endsection
