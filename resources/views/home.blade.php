@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
@endpush

@section('title', 'Home | Dasbor Pendaki')

@section('main')
    <h3>Daftar Gunung</h3>

    <ul>
        @foreach ($data_gunung as $gunung)
            <li><a href="/home/{{ $gunung->nama_gunung }}">{{ $gunung->nama_gunung }}</a></li>
        @endforeach
    </ul>
@endsection