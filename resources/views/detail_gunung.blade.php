@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/detail_gunung.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
@endpush

@section('title', 'Detail Gunung | Dasbor Pendaki')

@section('main')
<div class="container-fluid header"></div>
<div class="box-container">
    <div class="head-title" data-aos="fade-up">
        <h3><a href="/home" class="btn-back"><i class="fas fa-chevron-left"></i></a> Detail Gunung</h3>
        <hr class="under-split">
    </div>
    <div class="body-content d-flex">
        <div class="content-mount" data-aos="fade-up">
            <h6><img src="{{asset('storage/images/gunung/'.$gunung->gambar_gunung.'')}}" alt="" class="mount-pict"></h6>
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
                <i class="fas fa-cloud"></i>
                @if($gunung->cuaca == 0)
                <h6>Cuaca : <i class="fas fa-cloud-sun"></i> Cerah</h6>
                @elseif($gunung->cuaca == 1)
                <h6>Cuaca : <i class="fas fa-cloud-sun-rain"></i> Terkadang hujan</h6>
                @elseif($gunung->cuaca == 2)
                <h6>Cuaca : <i class="fas fa-cloud-showers-heavy"></i> Sering hujan</h6>
                @elseif($gunung->cuaca == 3)
                <h6 style="color: red;">Cuaca : <i class="fas fa-house-damage"></i> Bencana Alam</h6>
                @endif
            </div>
            <div class="mount-detail">
                <i class="material-icons-outlined">remove_circle_outline</i>
                @if($gunung->status == 0)
                <h6>Status : Buka</h6>
                @elseif($gunung->status == 1)
                <h6>Status : Tutup</h6>
                @endif
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