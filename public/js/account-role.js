$(document).ready(function () {
    var submitAjaxRequestRole = function (e) {

        var form = $(this);
        user_id = form.find('input[name="user_id"]').val();
        role_id = form.find('option:selected').val();
        $.ajax({
            type: 'POST',
            url: form.prop('action'),
            data: {'_token': Globals._token, 'user_id': user_id, 'role_id': role_id},
            success: function (data) {
            }
        });

        e.preventDefault();
    };

    $("form[data-remote]").on("submit", submitAjaxRequestRole);

    $('.selectpicker').on('change', function (e) {

        $(this).closest('form').submit();
        $('.flash').empty().append('Акаунтът е обновен!').fadeIn(500).delay(300).fadeOut(500);
    });

    $("select[name='role']").on('click',function(e){
        console.log($(this).first().children().attr("selected"));
    });
});