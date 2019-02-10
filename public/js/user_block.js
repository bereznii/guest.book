$(document).ready(function(){
    var id = $('td#id').html();
    $("i#lock-"+id).on('click', function() {
        event.preventDefault();
        var user_id = $(this).attr('id').split('-')[1];
        var blocked = $(this).attr('do_status');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/user/'+user_id,
            type: 'post',
            data: {_method: 'patch', id:user_id, blocked: blocked},
            success: function (data) {
                if(blocked == 1) {
                    $('i#lock-'+id).toggleClass('fa-lock-open fa-lock');
                    $('i#lock-'+id).attr('do_status', '0');
                } else {
                    $('i#lock-'+id).toggleClass('fa-lock fa-lock-open');
                    $('i#lock-'+id).attr('do_status', '1');
                }
            }
        })
    });
});