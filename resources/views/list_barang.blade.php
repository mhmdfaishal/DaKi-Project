<div class="row row-cols-5">
@foreach($barangs as $barang)
    <div class="card">
        <img class="card-img-top" src="{{asset('images/logo6.png')}}" alt="Gambar barang">
        <div class="card-body">
            <div class="detail-other">
                <h5 class="card-title nama-barang">{{$barang->nama_barang}}</h5>
                <p class="card-text"></p>
                <p class="card-text"><small class="text-muted"><i class="fas fa-money-bill-wave"></i> Rp {{number_format($barang->harga,0,',','.') }}/{{$barang->interval_number}} {{$barang->interval}}</small></p>
                @if (Auth::user()->role != 2)
                <form class="d-flex" id="form-cart-{{$barang->id}}">
                    <input type="text" name="id_barang" id="id_barang" value="{{$barang->id}}" hidden>
                    <input type="number" class="card-quantity" id="quantity-{{$barang->id}}" name="quantity" value="1" min="1" max="20">
                    <button type="submit" class="cart-btn" data-id="{{$barang->id}}"><i class="fas fa-cart-plus"></i></button>
                </form>
                @endif
            </div>
        </div>
    </div>
@endforeach
</div>
{{$barangs->links()}}
