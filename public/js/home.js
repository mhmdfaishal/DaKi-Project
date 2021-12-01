$(document).on('click', '#list_gunung', function () {
    var id = $(this).data('id');
    window.location.href = '/home/'+id;
});