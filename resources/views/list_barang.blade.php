@if(isset($has_barang[0]))
<div class="row row-cols-5">
    @foreach($barangs as $barang)
        <div class="card" id="detail-barang" data-id="{{$barang->id}}">
            <img class="card-img-top card-gambar-barang" id="card-gambar-barang-{{$barang->id}}" src="{{asset('storage/images/toko/'.$barang->toko->nama_toko.'/barang'.'/'.$barang->gambar_barang)}}" alt="Gambar barang">
            <p class="title-detail-barang" id="title-detail-barang-{{$barang->id}}" style="display: none;"><i class="far fa-eye"></i> Detail Barang</p>
            <div class="card-body">
                <div class="detail-other">
                    <h5 class="card-title nama-barang">{{$barang->nama_barang}}</h5>
                    <p class="card-text"></p>
                    <p class="card-text"><small class="text-muted"><i class="fas fa-money-bill-wave"></i> Rp {{number_format($barang->harga,0,',','.') }}/{{$barang->interval_number}} {{$barang->interval}}</small></p>
                    @if (Auth::check() && $barang->toko->user->email != Auth::user()->email)
                    <form class="d-flex" id="form-cart-{{$barang->id}}">
                        <input type="text" name="id_barang" id="id_barang" value="{{$barang->id}}" hidden>
                        <input type="number" class="card-quantity" id="quantity-{{$barang->id}}" name="quantity" value="1" min="1" max="20">
                        <button type="submit" class="cart-btn" data-id="{{$barang->id}}"><i class="fas fa-cart-plus"></i></button>
                    </form>
                    @elseif(Auth::check() && Auth::user()->role == 2 && $barang->toko->user->email == Auth::user()->email)
                    <div class="btn-set d-flex justify-content-center">
                        <button type="button" class="btn-card edit-barang-btn" id="edit-barang-btn" data-id="{{$barang->id}}"><i class="far fa-edit"></i>Edit</button>
                        <button type="button" class="btn-card delete-barang-btn" id="delete-barang-btn" data-id="{{$barang->id}}"><i class="fas fa-trash-alt"></i>Hapus</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@else
    <h2 class="empty-store">Tidak ada barang.</h2>
@endif
{{$barangs->links()}}
