@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/profile_user.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('title', 'Profile | Dasbor Pendaki')

@section('main')

<div class="container-update">
    <h2 class="title-profile"><a href="/home" class="btn-back"><i class="fas fa-chevron-left"></i></a> Profile</h2>
    <hr>
    <div class="container-form">
      <form id="form-profile">
        @csrf
            <div class="mb-3 row">
              <label for="nama_user" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" @if(isset($getuser)) value="{{$getuser->nama }}" @endif id="nama_user" name="nama_user" style="border-radius: 12px" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="email_user" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" @if(isset($getuser)) value="{{$getuser->email }}" @endif id="email_user" name="email_user" style="border-radius: 12px" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="alamat_user"  style="border-radius: 12px" required>@if(isset($getuser)) {{ $getuser->alamat }} @endif</textarea>
                @if (session('is_alamat_not_filled'))
                <p><b style="color: red;">Alamat harus diisi terlebih dahulu!</b> </p>
                @endif
            </div>
            </div>
            <div class="mb-3 row">
              <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="old_password" style="border-radius: 12px;">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="new_password" style="border-radius: 12px" value="" placeholder="Masukkan password baru jika ingin mengganti password">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="password_confirm" class="col-sm-2 col-form-label">Confirm Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="password_confirm" style="border-radius: 12px" value="" placeholder="Masukkan password baru jika ingin mengganti password">
                <p id="validation_confirm"></p>
            </div>
            </div>
            <div class="d-flex container justify-content-center">
              <button type="submit" class="btn btn-outline-success btn-save"><i class="far fa-save"></i> Save </button>
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
  <script src="{{asset('js/cruduser.js')}}"> </script>
@endpush