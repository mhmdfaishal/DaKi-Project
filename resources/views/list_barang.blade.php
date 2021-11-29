<div class="row row-cols-5">
@foreach($barangs as $barang)
    <div class="card">
        <img class="card-img-top" src="{{asset('images/logo6.png')}}" alt="Gambar barang">
        <div class="card-body">
            <div class="detail-other">
                <h5 class="card-title nama-barang">{{$barang->nama_barang}}</h5>
                <p class="card-text"></p>
                <p class="card-text"><small class="text-muted"><i class="fas fa-money-bill-wave"></i> Rp {{number_format($barang->harga,0,',','.') }}/{{$barang->interval_number}} {{$barang->interval}}</small></p>
            </div>
        </div>
    </div>
@endforeach
</div>
{{$barangs->links()}}
