@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/info_toko_admin.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
@endpush

@section('title', 'Info Toko | Dasbor Pendaki')

@section('main')
<div class="container-fluid header">
    <div class="head-title" data-aos="fade-up">
      <h3>Info Toko</h3>
      <hr class="under-split">
    </div>
  </div>
{{-- <div class="content">
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
</div> --}}

<div class="container-update">
    <div class="container-form">
      @if(isset($data))
      <img class="form-img" src="{{ asset('storage/images/toko/'.$data->logo_toko)}}" alt="gambar">
      @else
      <img class="form-img" src="{{asset('images/cam.png') }}" alt="gambar">
      @endif
      <form id="form-toko" enctype="multipart/form-data">
        @csrf
            <div class="mb-3 row">
              @if(isset($data))
              <input type="hidden" name="id_toko" value="{{$data->id}}" id="id_toko">
              @else
              <input type="hidden" name="id_toko" value="null" id="id_toko">
              @endif
              <label for="nama_toko" class="col-sm-2 col-form-label">Nama Toko</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" @if(isset($data)) value="{{$data->nama_toko }}" @endif id="nama_toko" style="border-radius: 12px" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="alamat" @if(isset($data)) value="{{$data->alamat }}" @endif style="border-radius: 12px" required>@if(isset($data)) {{ $data->alamat }} @endif</textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="url_gmaps" class="col-sm-2 col-form-label">URL Gmaps</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="url_gmaps" @if(isset($data)) value="{{ $data->url_gmaps }}"  @endif style="border-radius: 12px">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="kota_kabupaten" class="col-sm-2 col-form-label">Kota/Kabupaten</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="kota_kabupaten"@if(isset($data)) value="{{ $data->kotakabupaten }}" @endif style="border-radius: 12px">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="kontak" class="col-sm-2 col-form-label">Kontak</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="kontak" @if(isset($data)) value="{{ $data->kontak }}" @endif style="border-radius: 12px" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="gambar_toko" class="col-sm-2 col-form-label">Foto Toko</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" id="gambar_toko" style="border-radius: 12px" accept=" .png, .jpg, .jpeg"  required>
              </div>
            </div>
            <div class="d-flex container justify-content-center">
              @if(isset($data))
              <button type="submit" class="btn btn-outline-success btn-save"><i class="far fa-save"></i> Save </button>
              <button type="button" id="delete_button" data-id="{{$data->id}}" class="btn btn-outline-danger btn-delete"><i class="fas fa-trash-alt"></i> Delete </button>
              @else
              <button type="submit" class="btn btn-outline-success btn-post"><i class="fas fa-paper-plane"></i> Post </button>
              @endif
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js" integrity="sha256-siqh9650JHbYFKyZeTEAhq+3jvkFCG8Iz+MHdr9eKrw=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
  </script>
  <script src="{{asset('js/crudtoko.js')}}"> </script>
@endpush