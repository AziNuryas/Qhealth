<!-- resources/views/admin/answers/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Detail Jawaban</h1>
    <p>ID: {{ $answer->id }}</p>
    <p>Isi: {{ $answer->content }}</p>
    <!-- Sesuaikan dengan kolom di tabel answers -->
@endsection
