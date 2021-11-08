@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/daftar_pesanan.css') }}">
@endpush

@section('title', 'Home | Dasbor Pendaki')

@section('main')
    <div class="body-content">
        <h1 class="head-title"> Daftar Pesanan 
        <hr class="split-title">
        <div class="list-pesanan container">
            <div class="order-content d-flex">
                <h1>Amir</h1>
                <h2><i class="fas fa-shopping-cart"></i> 2 Barang</h2>
                <h3><i class="fas fa-hand-holding-usd"></i> 600K</h3>
            </div>
            <div class="order-content d-flex">
                <h1>Amir</h1>
                <h2><i class="fas fa-shopping-cart"></i> 2 Barang</h2>
                <h3><i class="fas fa-hand-holding-usd"></i> 600K</h3>
            </div>
            <div class="order-content d-flex">
                <h1>Amir</h1>
                <h2><i class="fas fa-shopping-cart"></i> 2 Barang</h2>
                <h3><i class="fas fa-hand-holding-usd"></i> 600K</h3>
            </div>
        </div>
        <div>
            <a href="" class="prev"> < Previous </a>
            <a href="" class="next"> Next ></Next> </a>
        </div>
    </div>
@endsection