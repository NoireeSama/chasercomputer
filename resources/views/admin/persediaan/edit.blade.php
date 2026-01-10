@extends('layouts.master')
@section('title', 'Edit Persediaan')
@section('content')
    <h2>Edit Persediaan</h2>
    @include('admin.persediaan._form', [
        'action' => route('persediaan.update', $persediaan->id),
        'method' => 'PUT',
        'persediaan' => $persediaan,
        'produks' => $produks
    ])
@endsection
