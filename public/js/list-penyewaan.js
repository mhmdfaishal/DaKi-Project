$(document).ready(function() {
    $(document).on('click','button#btn-detail-penyewaan',function(event){
        var id = $(this).data('id');
        event.preventDefault();
        $.get(`/sewa/detailpenyewaan/${id}`,                                   
        function (data) {
          $('#modal-detail-penyewaan').modal('show');
          $('#tgl-sewa').html(data.tanggal);
          $('#nama-user').html(data.nama);
          $('#nama-toko').html(data.nama_toko);
          $('#alamat-toko').html(data.alamat);
          $('#kontak-toko').html(data.kontak);
          $("#detail-transaksi tbody").html('');
          $.each(data.keranjang, function (i, barang) {
            console.log(barang.no_transaksi);
            $("#detail-transaksi tbody").append(
                `<tr>
                  <td>${i+1}</td>
                  <td>${data.alat[i].nama_barang}</td>
                  <td>${barang.kuantitas}</td>
                  <td>${data.alat[i].harga}</td>
                  <td>${data.lama_penyewaan} Hari</td>
                  <td>Rp ${(data.alat[i].harga * barang.kuantitas * data.lama_penyewaan).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                </tr>`
            ) 
          });
          $("#detail-transaksi tbody").append(
                `<tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><b>Total Pembayaran</b></td>
                  <td>Rp ${(data.total_semua_harga).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                </tr>`
            ) 
        })
    });
});