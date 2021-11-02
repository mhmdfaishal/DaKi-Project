<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Gunung</title>
</head>
<body>
    <h2>Nama Gunung : {{ $gunung->nama_gunung }}</h2>
    <h6><img src="{{asset('images/'.$gunung->gambar_gunung.'')}}" alt=""></h6>
    <h6>Lokai : <a href="{{$gunung->url_gmaps}}" target="_blank">{{ $gunung->lokasi }}</a></h6>
    <h6>Status : {{ $gunung->status }}</h6>
    <h6>Ketinggian : {{ $gunung->ketinggian }}</h6>
    <h6>Kuota Pendaki : {{ $gunung->kuota_pendaki }}</h6>
    <h6>Kontak : {{ $gunung->kontak }}</h6>
</body>
</html>