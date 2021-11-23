if ($("#form-gunung").length > 0) {
    $("#form-gunung").validate({
        submitHandler: function (form) {
            let formData = new FormData();
            const gambar = $('#gambar_gunung').prop('files')[0];
            formData.append('id_gunung', $('#id_gunung').val());
            formData.append('nama_gunung', $('#nama_gunung').val());
            formData.append('lokasi', $('#lokasi').val());
            formData.append('provinsi_id', $('#provinsi').val());
            formData.append('url_gmaps', $('#url_gmaps').val());
            formData.append('ketinggian', $('#ketinggian').val());
            formData.append('htm', $('#htm').val());
            formData.append('status', $('#status').val());
            formData.append('kuota_pendaki', $('#kuota_pendaki').val());
            formData.append('kontak', $('#kontak').val());
            formData.append('gambar_gunung', gambar);
            $.ajax({
                url: "/basecamp/gunung/store", 
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
        }
    })
}

$(document).on('click', '#delete_button', function(event){
    event.preventDefault(); 
    var id = $(this).data('id');
    $.ajax({
        url: "/basecamp/gunung/delete/"+id, 
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