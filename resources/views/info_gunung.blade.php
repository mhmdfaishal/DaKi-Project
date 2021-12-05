@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/update_gunung.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('title', 'Kelola Gunung | Dasbor Pendaki')

@section('main')

<div class="container-update">
    <h2 class="title-basecamp"><a href="/home" class="btn-back"><i class="fas fa-chevron-left"></i></a> Kelola Gunung</h2>
    <hr>
    <div class="container-form">
      @if(isset($getgunung))
      <img class="form-img" src="{{ asset('storage/images/gunung/'.$getgunung->gambar_gunung.'') }}" alt="gambar">
      @else
      <img class="form-img" src="{{ asset('images/home.jpg') }}" alt="gambar">
      @endif
      <form id="form-gunung" enctype="multipart/form-data">
        @csrf
            <div class="mb-3 row">
              @if(isset($getgunung))
              <input type="hidden" name="id_gunung" value="{{$getgunung->id}}" id="id_gunung">
              @else
              <input type="hidden" name="id_gunung" value="null" id="id_gunung">
              @endif
              <label for="nama_gunung" class="col-sm-2 col-form-label">Nama Gunung</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" @if(isset($getgunung)) value="{{$getgunung->nama_gunung }}" @endif id="nama_gunung" style="border-radius: 12px" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="lokasi" class="col-sm-2 col-form-label">Alamat Lengkap</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="lokasi"  style="border-radius: 12px" required>@if(isset($getgunung)) {{ $getgunung->lokasi }} @endif</textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
              <div class="col-sm-10">
                @if(isset($getgunung))
                <input type="hidden" name="provinsi_user" id="provinsi_user" value="{{$getgunung->provinsi->nama_provinsi}}">
                @else
                <input type="hidden" name="provinsi_user" id="provinsi_user" value="Provinsi">
                @endif
                <select id="provinsi" class="form-control" style="width:100% !important; border-radius:12px !important;" required>
                  <option value="">Pilih Provinsi</option>
                  @foreach($provinces as $provinsi)
                  <option value="{{$provinsi->id}}">{{$provinsi->nama_provinsi}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="gmaps" class="col-sm-2 col-form-label">Gmaps</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="url_gmaps" @if(isset($getgunung)) value="{{ $getgunung->url_gmaps }}" @endif style="border-radius: 12px" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="ketinggian" class="col-sm-2 col-form-label">Ketinggian</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="ketinggian" @if(isset($getgunung)) value="{{$getgunung->ketinggian}}" @endif style="border-radius: 12px" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="htm" class="col-sm-2 col-form-label">Harga Tiket Masuk</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="htm" @if(isset($getgunung)) value="{{$getgunung->htm}}" @endif style="border-radius: 12px" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="status" class="col-sm-2 col-form-label">Cuaca</label>
              <div class="col-sm-10">
                <select class="form-select" id="cuaca" aria-label="Default select example" value="3"  style="border-radius: 12px" required>
                  <option selected disabled>Cuaca</option>
                  @for ($i = 0; $i <= 3; $i++)
                  @if($i == 0)
                  <option value="{{$i}}" @if(isset($getgunung)){{($i == $getgunung->cuaca) ? 'selected' : ''}}@endif ><i class="fas fa-cloud-sun"></i> Cerah</option>
                  @elseif($i == 1)
                  <option value="{{$i}}" @if(isset($getgunung)){{($i == $getgunung->cuaca) ? 'selected' : ''}}@endif ><i class="fas fa-cloud-sun-rain"></i> Terkadang hujan</option>
                  @elseif($i == 2)
                  <option value="{{$i}}" @if(isset($getgunung)){{($i == $getgunung->cuaca) ? 'selected' : ''}}@endif ><i class="fas fa-cloud-showers-heavy"></i> Sering hujan</option>
                  @elseif($i == 3)
                  <option value="{{$i}}" @if(isset($getgunung)){{($i == $getgunung->cuaca) ? 'selected' : ''}}@endif ><i class="fas fa-house-damage"></i> Bencana alam</option>
                  @endif
                  @endfor 
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="status" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-select" id="status" aria-label="Default select example" @if(isset($getgunung)) value="{{$getgunung->status}}" @endif  style="border-radius: 12px" required>
                  <option selected disabled>Status</option>
                  @for ($i = 0; $i <= 1; $i++)
                  <option value="{{$i}}" @if(isset($getgunung)) {{($i == $getgunung->status) ? 'selected' : ''}}@endif>{{($i==0) ? 'Buka' : 'Tutup' }}</option>
                  @endfor 
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="kuota_pendaki" class="col-sm-2 col-form-label">Kuota Pendaki</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="kuota_pendaki" @if(isset($getgunung)) value="{{$getgunung->kuota_pendaki}}" @endif style="border-radius: 12px" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="kontak" class="col-sm-2 col-form-label">Kontak</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="kontak" @if(isset($getgunung)) value="{{$getgunung->kontak}}" @endif style="border-radius: 12px" required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="gambar_gunung" class="col-sm-2 col-form-label">Foto Gunung</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" id="gambar_gunung" style="border-radius: 12px" required>
              </div>
            </div>
            <div class="d-flex container justify-content-center">
              @if(isset($getgunung))
              <button type="submit" class="btn btn-outline-success btn-save"><i class="far fa-save"></i> Save </button>
              <button type="button" id="delete_button" data-id="{{$getgunung->id}}" class="btn btn-outline-danger btn-delete"><i class="fas fa-trash-alt"></i> Delete </button>
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
    var provinsi = $('#provinsi_user').val();
    $("#provinsi").select2( {
      placeholder: provinsi,
      allowClear: true
    });
  </script>
  <script>
    $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
  </script>
  <script src="{{asset('js/crudgunung.js')}}"> </script>
@endpush