const params = new URLSearchParams(window.location.search);
    
function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
        return uri + separator + key + "=" + value;
    }
}
function fetch_data(page,id){
    $.get("/fetchbarang?page=" + page +"&id="+id,                                   
        function (data) {
            var newUrl=updateQueryStringParameter(window.location.href,"page",page);
            window.history.pushState("", "Daki", newUrl);
            $('#list-barang').html(data);
            var id = $('#id_barang').val();
            $('.cart-btn').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');                
                let formData = new FormData();
                event.preventDefault();
                formData.append('id_barang', id);
                formData.append('quantity', $('#quantity-'+id).val());
                $.ajax({
                    url: "/keranjang/add", 
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
                        }
                    },
                    error: function (data) { le
                        console.log('Error:', data);
                    }
                });
              })
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
                      $('#gambar_barang').attr('src',`../storage/images/toko/`+data.nama_toko+`/barang/`+data.data.gambar_barang+``);
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
    })
    
}

$(document).ready(function(){
      $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        var id = $('#id_toko').val();
        fetch_data(page,id);
      });
      $('#searchform').submit(function(event){
        var search = $('#search_input').val();
        var id = $('#id_toko').val();
        event.preventDefault();
        $.get("/fetchbarang?search=" + search+"&id="+id,                                   
            function (data) {
                var newUrl=updateQueryStringParameter(window.location.href,"search",search.replace(/ /g,"+").toLowerCase());
                window.history.pushState("", "Daki", newUrl);
                console.log(data);
            $('#list-barang').html(data);
            var id = $('#id_barang').val();
            $('.cart-btn').click(function(event){
                event.preventDefault();
                var id = $(this).data('id');                
                let formData = new FormData();
                event.preventDefault();
                formData.append('id_barang', id);
                formData.append('quantity', $('#quantity-'+id).val());
                $.ajax({
                    url: "/keranjang/add", 
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
                        }
                    },
                    error: function (data) { le
                        console.log('Error:', data);
                    }
                });
              })
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
                      $('#gambar_barang').attr('src',`../storage/images/toko/`+data.nama_toko+`/barang/`+data.data.gambar_barang+``);
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
        })
      });
});