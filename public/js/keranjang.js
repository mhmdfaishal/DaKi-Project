var id = $('#id_barang').val();

$(document).ready(function(){
    $('button#btn-minus').click(function(event){
        var id = $(this).data('id');
        event.preventDefault();
        let formData = new FormData();
        formData.append('barang_id', id);
        $.ajax({
            url: "/keranjang/store/minus", 
            data: formData, 
            type: "POST", 
            dataType: 'json', 
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {  
                if(typeof(data.error) != "undefined"){
                    
                }else{
                    $("p#kuantitas-"+id).html(``+data.data.kuantitas+` Pcs`);
                    $("div#total-harga-"+id).html(`Rp `+data.total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $("div#total-keseluruhan-harga").html(`Rp `+data.total_keseluruhan_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                }
            },
            error: function (data) { le
                console.log('Error:', data);
            }
        });
    })
    $('button#button-delete-barang').click(function(event){
        var id = $(this).data('id');
        event.preventDefault();
        let formData = new FormData();
        formData.append('barang_id', id);
        $.ajax({
            url: "/keranjang/barang/delete/"+id, 
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
    })
    $('button#btn-plus').click(function(event){
        var id = $(this).data('id');
        event.preventDefault();
        let formData = new FormData();
        formData.append('barang_id', id);
        $.ajax({
            url: "/keranjang/store/plus", 
            data: formData, 
            type: "POST", 
            dataType: 'json', 
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {  
                if(typeof(data.error) != "undefined"){
                    
                }else{
                    $("p#kuantitas-"+id).html(``+data.data.kuantitas+` Pcs`);
                    $("div#total-harga-"+id).html(`Rp `+data.total_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $("div#total-keseluruhan-harga").html(`Rp `+data.total_keseluruhan_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                }
            },
            error: function (data) { le
                console.log('Error:', data);
            }
        });
    })
    $('#btn-lanjutkan').click(function(event){
        var id = $(this).data('id');
        event.preventDefault();
        let formData = new FormData();
                event.preventDefault();
                formData.append('barang_id', id);
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
                            if(data.jumlah>0){
                                $('#btn-popup-cart').show();
                                $('#jumlah-barang-popup-cart').html(data.jumlah);
                            }else if(data.jumlah<=0){
                                $('#btn-popup-cart').hide();
                            }
                            iziToast.success({
                                title: data.message,
                                message: 'Success',
                                position: 'topRight'
                            });
                            $('#modal-diff-store').modal('hide');
                            
                        }
                    },
                    error: function (data) { le
                        console.log('Error:', data);
                    }
                });
    })
    $('.cart-btn').click(function(event){
    event.preventDefault();
    var id = $(this).data('id');
    $.get("/keranjang/cekbarang/" + id,                                   
        function (data) {
            if(data.is_diff_store){
                $('#modal-diff-store').modal('show');
                $('#btn-lanjutkan').attr('data-id',id);
            }else{
<<<<<<< HEAD
                iziToast.success({
                    title: data.message,
                    message: 'Success',
                    position: 'topRight'
=======
                let formData = new FormData();
                event.preventDefault();
                formData.append('barang_id', id);
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
                            if(data.jumlah>0){
                                $('#btn-popup-cart').show();
                                $('#jumlah-barang-popup-cart').html(data.jumlah);
                            }else if(data.jumlah<=0){
                                $('#btn-popup-cart').hide();
                            }
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
>>>>>>> origin/main
                });
            }
    })
    
    
    })
});