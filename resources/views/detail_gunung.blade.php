@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
@endpush

@section('title', 'Detail Gunung | Dasbor Pendaki')

@section('main')
<h2>Nama Gunung : {{ $gunung->nama_gunung }}</h2>
<h6><img src="{{asset('images/'.$gunung->gambar_gunung.'')}}" alt=""></h6>
<h6>Terletak di <a href="{{$gunung->url_gmaps}}" target="_blank">{{ $gunung->lokasi }}</a></h6>
<h6>Status : {{ $gunung->status }}</h6>
<h6>Ketinggian : {{ $gunung->ketinggian }}</h6>
<h6>Kuota Pendaki : {{ $gunung->kuota_pendaki }}</h6>
<h6>Kontak : {{ $gunung->kontak }}</h6>
@endsection