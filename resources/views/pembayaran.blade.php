@extends('layout')

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/pembayaran.css') }}">

@endpush

@section('title', 'Pembayaran | Dasbor Pendaki')

@section('main')
<div class="wrap-pembayaran">
    <div class="title">
        <p>Pembayaran</p>
    </div>
    <div class="content">
        <table>
            <tr>
                <td class="data">Tanggal Penyewaan</td>
                <td>:</td>
                <td class="answer d-flex col-md-4">
                    <input type="text" class="form-control" id="tgl_penyewaan" name="tgl_penyewaan" value="01/01/2021 - 01/02/2021" required/>
                </td>
            </tr>
            <tr>
                <td class="data">Nama Penyewa</td>
                <td>:</td>
                <td class="answer">{{$user->nama}}</td>
            </tr>
            <tr>
                <td class="data">Alamat</td>
                <td>:</td>
                <td class="answer">{{$user->alamat}}</td>
            </tr>
            <tr>
                <td class="data">Kuantitas</td>
                <td>:</td>
                <td class="answer">{{$keranjangs->count()}} Barang</td>
            </tr>
            <tr>
                <td class="data">Total Harga / Hari</td>
                <td>:</td>
                <td class="answer">Rp {{number_format($total_harga,0,',','.')}} / 1 hari</td>
            </tr>
            <tr>
                <td class="data">Total Bayar</td>
                <td>:</td>
                <td class="answer" id="total-harga-penyewaan"><b>Rp {{number_format($total_harga,0,',','.')}}</b></td>
            </tr>
            <tr>
                <td class="data">No. Rekening</td>
                <td>:</td>
                <td class="answer" id="no-rek">{{env('PROVIDER_REK')}} / {{env('NO_REK')}} a.n. {{env('NAMA_REK')}}</td>
            </tr>
            <tr>
                <td class="data">Bukti Pembayaran</td>
                <td>:</td>
                <td class="answer"><input type="file" id="bukti_pembayaran" name="bukti_pembayaran" required></td>
            </tr>
        </table>

        <p id="validation" style="color: rgb(250, 106, 106);"></p>

    </div>
    <div class="navigation">
        <a href="/keranjang" class="back"><i class="fas fa-chevron-left"></i> Kembali</a>
        <a href="#" class="submit" id="bayar">Submit <i class="fas fa-chevron-right"></i></a>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

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

    <script src={{ asset('js/transaksi.js') }}></script>
@endpush