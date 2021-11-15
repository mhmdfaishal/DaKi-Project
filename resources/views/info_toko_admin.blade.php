@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/info_toko_admin.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
@endpush

@section('title', 'Info Toko | Dasbor Pendaki')

@section('main')
<center>
    <h2>Info Toko</h2>
</center>
<div class="content">
    <div class="button">
        <ul class="left">
            <button>Edit</button>
        </ul>
    </div>
    <table style="margin-left: auto; margin-right: auto;">
        <tr>
            <td colspan="2" style="text-align: center; padding-bottom: 30px;"><img src="{{asset('images/cam.png') }}" alt="Gambar Toko"></td>
        </tr>
        <tr>
            <td>Nama Toko</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Lokasi</td>
            <td>
                <input type="text">
            </td>
        </tr>
        <tr>
            <td>Deskripsi Toko</td>
            <td>
                <input type="text" style="height: 70px;">
            </td>
        </tr>
    </table>
</div>
@endsection