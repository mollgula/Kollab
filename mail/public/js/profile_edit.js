$(function() {
    $('#lefile').on('change', function(e) {
        let render = new FileReader();
        render.onload = function(e) {
            $('#preview').attr('src', e.target.result);
        }
        render.readAsDataURL(e.target.files[0]);
    })
});