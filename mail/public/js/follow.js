$(function() {
    $('.follow').on('click', function() {
        let parent = $(this).parent();
        let parent_id = parent.find('.follow_id');
        let follow_user_id = parent_id.val();
        let follow_parent_class = parent.find('.follow');

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: '/follow_request',
            type: 'post',
            dataType: 'json',
            data: {
                "follow_id": follow_user_id
            }
        }).then(function() {
            //
        }).catch(function() {
            // $follow_user_idはpostできているがcatchになる
            follow_parent_class.text('フォローリクエスト中');
        })
    })
})
