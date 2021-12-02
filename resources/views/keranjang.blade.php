@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/keranjang.css') }}">
@endpush

@section('title', 'Keranjang | Dasbor Pendaki')
@section('main')
<div class="wrap-keranjang">
    <div class="head-title" data-aos="fade-up">
        <h3><a href="/sewa" class="btn-back"><i class="fas fa-chevron-left"></i></a> KERANJANG</h3>
      </div>
    <div>
        <table class="content">
            <tr class="table-title">
                <th>No</th>
                <th class="img">Gambar</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Harga</th>
                <th>Action</th>
            </tr>
            @foreach($data as $k => $barang)
            <tr class="list-barangs">
                <td>{{$k+1}}</td>
                <td><img src="{{asset('storage/images/toko/'.$barang->barang->toko->nama_toko.'/barang'.'/'.$barang->barang->gambar_barang.'')}}" alt=""></td>
                <td>{{$barang->barang->nama_barang}}</td>
                <td class="jumlah-barang">
                    <div id="jumlah-barang" class="d-flex justify-content-center">
                        <button class="btn-minus" id="btn-minus" data-id="{{$barang->barang_id}}"><i class="fas fa-minus"></i></button> 
                        <p class="kuantitas-barang" id="kuantitas-{{$barang->barang_id}}">
                            {{$barang->kuantitas }} Pcs 
                        </p>
                        <button class="btn-plus" id="btn-plus" data-id="{{$barang->barang_id}}"><i class="fas fa-plus"></i></button>
                    </div>
                </td>
                <td class="harga">Rp {{number_format($barang->barang->harga,0,',','.') }} </td>
                <td class="total-harga">
                    <div id="total-harga-{{$barang->barang_id}}">
                        Rp {{ number_format($barang->barang->harga*$barang->kuantitas,0,',','.')}}
                    </div>
                </td>
                <td>
                    <form action="">
                        <button type="button" id="button-delete-barang" data-id="{{$barang->barang_id}}" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            <div class="container">
                @if(isset($data[0]))
                <tr style="background-color: white;">
                    <td colspan="4"></td>
                    <td colspan="0">Total Harga :</td>
                    <td class="d-flex">
                        <div id="total-keseluruhan-harga">
                            Rp  {{number_format($total_harga,0,',','.')}}</td>
                        </div>
                        <td><a href="{{route('checkout')}}"><button class="checkout">Checkout <i class="fas fa-chevron-circle-right"></i></button></a></td>
                    </tr>
                @endif
            </div>
        </table>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
    integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js" integrity="sha256-siqh9650JHbYFKyZeTEAhq+3jvkFCG8Iz+MHdr9eKrw=" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    </script>
    <script src={{ asset('js/keranjang.js') }}></script>
@endpush