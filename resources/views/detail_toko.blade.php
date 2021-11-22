@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/detail_toko.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
@endpush

@section('title', 'Detail Toko | Dasbor Pendaki')

@section('main')
<div class="container-fluid header"></div>
<div class="box-container">
    <div class="head-title" data-aos="fade-up">
        <h3> Detail Toko </h3>
        <hr class="under-split">
    </div>
    <div class="body-content d-flex">
       @foreach ($barangs as $barang)
           
       @endforeach
    </div>
</div>
@endsection