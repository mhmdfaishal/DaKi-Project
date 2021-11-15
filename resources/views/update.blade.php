@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/update_gunung.css') }}">
@endpush

@section('title', 'Update Gunung | Dasbor Pendaki')

@section('main')
<div class="container-update">
    <div class="container-form">
            <img class="form-img" src="{{ asset('images/home.jpg') }}" alt="gambar">
    <form>
          <div class="mb-3 row">
            <label for="nama_gunung" class="col-sm-2 col-form-label">Nama Gunung</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_gunung" style="border-radius: 12px">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="lokasi" style="border-radius: 12px">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="ketinggian" class="col-sm-2 col-form-label">Ketinggian</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="ketinggian" style="border-radius: 12px">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="htm" class="col-sm-2 col-form-label">Harga Tiket Masuk</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="htm" style="border-radius: 12px">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="status" style="border-radius: 12px">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="kuota_pendaki" class="col-sm-2 col-form-label">Kuota Pendaki</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="kuota_pendaki" style="border-radius: 12px">
            </div>
          </div>
  </form>
</div>
</div>
@endsection

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
  integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
@endpush