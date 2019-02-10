$(document).ready(function(){
    $("i.fas.fa-trash").on('click', function() {
        event.preventDefault();
        var tr_id = $(this).attr('id');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/comment/'+tr_id,
            type: 'post',
            data: {_method: 'delete', id:tr_id},
            success: function (data) {
                $('#row-'+tr_id).remove();
            }
        })
    });
});