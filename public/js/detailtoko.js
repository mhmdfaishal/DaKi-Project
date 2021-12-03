$(document).ready(function(){
    $('#follow_button').click(function () {
        var id = $(this).data('id');
        let formData = new FormData();
        formData.append('toko_id', id);
        setTimeout(function(){  
            $.ajax({
                url: "/toko/followunfollow", 
                data: formData, 
                type: "POST", 
                dataType: 'json', 
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {  
                    $('#jumlah_follower').html(data.data);  
                    $('#follow_button').html(data.html);  
                },
                error: function (data) { le
                    console.log('Error:', data);
                }
            });
        },
        100);
    });

$('#btn-tambah-barang').click(function(event){
    event.preventDefault();
    $('#id_barang').val("");
})
$('#tombol-sewa').click(function(event){
    event.preventDefault();
    let formData = new FormData();
    if($('#gambar_barang').val() !== null) {
        const gambar_barang = $('#gambar_barang').prop('files')[0];
        formData.append('gambar_barang', gambar_barang);
    }
    if($('#id_barang').val() !== null) {
        const id_barang = $('#id_barang').val();
        formData.append('id_barang', id_barang);
    }
    formData.append('nama_barang', $('#nama_barang').val());
    formData.append('harga', $('#harga').val());
    formData.append('interval', $('#interval').val());
    formData.append('interval_number', $('#interval_number').val());
    formData.append('deskripsi', $('#deskripsi').val());
    
    $.ajax({
        url: "/toko/barang/store", 
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
                setTimeout(function(){
                    location.reload();
                },
                500);
            }
        },
        error: function (data) { le
            console.log('Error:', data);
        }
    });
})
var id = $('#id_barang').val();
$("div.btn-set button:contains('Hapus')").click(function(event){
    event.preventDefault(); 
    var id = $(this).data('id');
    $('#id_barang').val("");
    $.ajax({
        url: "/toko/barang/delete/"+id, 
        type: "DELETE", 
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
                iziToast.warning({
                    title: data.message,
                    message: 'Success',
                    position: 'topRight'
                });
                setTimeout(function(){
                    location.reload();
                },
                500);
            }
        },
        error: function (data) { le
            console.log('Error:', data);
        }
    });
  });
  $("div.btn-set button:contains('Edit')").click(function(event){
    var id_barang = $(this).data('id');
    event.preventDefault();
    $.get("/toko/barang/edit/" + id_barang,                                   
        function (data) {
          $('#modal-tambah-barang').modal('show');
          $('#id_barang').val(data.id);
          $('#nama_barang').val(data.nama_barang);
          $('#harga').val(data.harga);
          $('#interval').val(data.interval);
          $('#interval_number').val(data.interval_number);
          $('#deskripsi').val(data.deskripsi);
          $('#gambar_barang').val(data.gambar_barang);
    })
})
$("img.card-gambar-barang").click(function(event){
    var id_barang = $(this).data('id');
    event.preventDefault();
    $.get("/toko/barang/detailbarang/" + id_barang,                                   
        function (data) {
          $('#modal-detail-barang').modal('show');
          $('#gambar_barang_detail').attr('src',`../storage/images/toko/`+data.nama_toko+`/barang/`+data.data.gambar_barang+``);
          $('#get_nama_barang').html(data.data.nama_barang);
          $('#harga_interval').html(`Rp `+data.data.harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+`/`+data.data.interval_number+` `+data.data.interval+``);
          $('#get_deskripsi').html(data.data.deskripsi);
    })
})

$("div#detail-barang").mouseenter(function() {
    var id= $(this).data('id');
    $('#title-detail-barang-'+id).show();
    $('#card-gambar-barang-'+id).css("opacity", "0.5");
}).mouseleave(function() {
    var id= $(this).data('id');
    $('#title-detail-barang-'+id).hide();
    $('#card-gambar-barang-'+id).css("opacity", "1");
});
});