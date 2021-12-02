$(document).ready(function(){
    $(function() {
        $('input[name="tgl_penyewaan"]').daterangepicker({
        opens: 'left'
        }, function(start, end, label) {
            let formData = new FormData();
            var mulai = start.format('YYYY-MM-DD');
            var selesai = end.format('YYYY-MM-DD');
            formData.append('mulai', mulai);
            formData.append('selesai', selesai);

            $.ajax({
                url: "/keranjang/checkout/tanggalsewa", 
                data: formData, 
                type: "POST", 
                dataType: 'json', 
                processData: false,
                contentType: false,
                success: function (data) {  
                    if(typeof(data.error) != "undefined"){

                    }else{
                        $("td#total-harga-penyewaan").html(`<b>Rp `+data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+`</b>`);
                    }
                },
                error: function (data) { le
                    console.log('Error:', data);
                }
            });
        });
    });

    $('#bayar').click(function(event){
        var id = $(this).data('id');
        event.preventDefault();
        let formData = new FormData();
        const bukti = $('#bukti_pembayaran').prop('files')[0];
        formData.append('bukti_pembayaran', bukti);
        formData.append('tanggal_sewa', $('#tgl_penyewaan').val());

        $.ajax({
            url: "/keranjang/checkout/bayar", 
            data: formData, 
            type: "POST", 
            dataType: 'json', 
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {  
                if(typeof(data.error) != "undefined"){
                    
                }else{
                    var url = $('meta[name="url"]').attr('content');
                    window.location.href=""+url+"/sewa/penyewaan";
                }
            },
            error: function (data) { le
                console.log('Error:', data);
            }
        });
    })
});