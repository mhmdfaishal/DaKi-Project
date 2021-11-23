@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/detail_gunung.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
@endpush

@section('title', '{{$gunung->nama_gunung}} | Dasbor Pendaki')

@section('main')
<div class="container-fluid header"></div>
<div class="box-container">
    <div class="head-title" data-aos="fade-up">
        <h3>Detail Gunung</h3>
        <hr class="under-split">
    </div>
    <div class="body-content d-flex">
        <div class="content-mount" data-aos="fade-up">
            <h6><img src="{{asset('images/gunung/'.$gunung->gambar_gunung.'')}}" alt="" class="mount-pict"></h6>
            <h2>Gunung {{ $gunung->nama_gunung }}</h2>
            <div class="mount-detail">
                <i class="material-icons-outlined">location_on</i>
                <h6>Terletak di <a href="{{$gunung->url_gmaps}}" target="_blank">{{ $gunung->lokasi }}</a></h6>
            </div>
            <div class="mount-detail">
                <i class="material-icons-outlined">landscape</i>
                <h6>Ketinggian : {{ $gunung->ketinggian }} mdpl</h6>
            </div>
            <div class="mount-detail">
                <i class="material-icons-outlined">remove_circle_outline</i>
                <h6>Status : {{ $gunung->status }}</h6>
            </div>
            <div class="mount-detail">
                <i class="material-icons-outlined">person</i>
                <h6>Kuota Pendaki : {{ $gunung->kuota_pendaki }} orang</h6>
            </div>
            <div class="mount-detail">
                <i class="material-icons-outlined">call</i>
                <h6>Kontak : {{ $gunung->kontak }}</h6>
            </div>
        </div>
    </div>
</div>
@endsection