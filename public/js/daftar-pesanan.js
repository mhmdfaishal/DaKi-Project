$(document).ready(function() {
        $(document).on('click','button#btn-detail-penyewaan',function(event){
          var id = $(this).data('id');
          event.preventDefault();
          $.get(`/cart/detailpesanan/${id}`,                                   
          function (data) {
            console.log(data.penyewa);
            $('#modal-detail-penyewaan').modal('show');
            $('#tgl-sewa').html(data.tanggal);
            $('#nama-user').html(data.penyewa);
            $('#alamat-user').html(data.alamat_user);
            $("#detail-transaksi tbody").html('');
            $('#status').val(data.status);
            $('#update-status').attr('data-id',id);
            $.each(data.keranjang, function (i, barang) {
            
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
      $(document).on('click','button#update-status',function(event){
            var id = $(this).data('id');
            event.preventDefault();
            let formData = new FormData();
            formData.append('no_transaksi', id);
            formData.append('status', $('#status').val());
            $.ajax({
                url: "/cart/update_status", 
                data: formData, 
                type: "POST", 
                dataType: 'json', 
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {  
                    if(typeof(data.error) != "undefined"){
                        iziToast.warning({
                            title: data.error,
                            message: 'Failed',
                            position: 'topRight'
                        });
                    }else{
                        iziToast.success({
                            title: data.message,
                            message: 'Success',
                            position: 'topRight'
                        });
                        location.reload();
                    }
                },
                error: function (data) { le
                    console.log('Error:', data);
                }
            });
      });
});