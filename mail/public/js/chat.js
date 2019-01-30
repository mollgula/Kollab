$(function() {
    $('#send').on('click', function() {
        let chat_id = $('#chat_id').val();
        let send_message = $('#message').val();

        if (send_message.length !== 0) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/send_message',
                type: 'post',
                dataType: 'json',
                data: {
                    'chat_id': chat_id,
                    'send_message': send_message
                }
            }).done(response => {
            }).fail(error => {
                $('#message').val('');
                location.reload();
                $('.auto_scroll').animate({ scrollTop: $('#message_list')[0].scrollHeight });
            })
        }
    })
});
