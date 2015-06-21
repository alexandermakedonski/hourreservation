$(document).ready(function () {
    var uploader = new plupload.Uploader({
        runtimes: 'html5',
        browse_button: 'avatar-upload',
        chunk_size: '50kb',
        url: '/auth/avatar',
        multi_selection: false,
        flash_swf_url: '/js/vendor/plupload/Moxie.swf',
        silverlight_xap_url: '/js/vendor/plupload/Moxie.xap',
        filters: {
            mime_types: [
                {title: "Image files", extensions: "jpg,gif,png,jpeg"}
            ]
        }
    });
    uploader.init();
    uploader.bind('FilesAdded', function (up, files) {
        $('#avatar-upload').empty();
        $.each(files, function () {

            var img = new mOxie.Image();

            img.onload = function () {
                this.embed($('#avatar-upload').get(0), {
                    width: 100,
                    height: 100,
                    crop: true
                });
            };

            img.onembedded = function () {
                this.destroy();
            };

            img.onerror = function () {
                this.destroy();
            };

            img.load(this.getSource());

        });
        if (uploader.files.length > 1){
            uploader.splice(0,uploader.files.length-1)
            uploader.refresh();
            console.log(uploader.files.length);
        }

    });

    uploader.bind('BeforeUpload', function (up, file) {
        up.settings.multipart_params = {"email": $('input[name="email"]').val(), "_token": Globals._token};
    });

    uploader.bind('UploadComplete',function(up, files){
        $.ajax({
            url: '/accounts/accounts/?page='+$( ".page-users").size(),
            type: "GET", // not POST, laravel won't allow it
            success: function(data){
                $data = $(data); // the HTML content your controller has produced
                $('.ajax-users-load').html($data);
            }
        });
        $('.panel-body').hide();
        $('input[name="name"]').val('');
        $('input[name="email"]').val('');
        $('input[name="password"]').val('');
        $('input[name="password_confirmation"]').val('');
        $('#avatar-upload').empty();
        $('#multiple-optgroups').multiselect('deselectAll', false);
        $('#multiple-optgroups').multiselect('updateButtonText');
    });

    var submitAjaxAccountCreate = function (e) {
        var form = $(this);
        data = form.serialize();
        $.ajax({
            type: 'POST',
            url: form.prop('action'),
            data: data,
            success: function (data) {
                if (data.fail) {


                    $('[data-show-error]').hide().popover('hide');

                    $.each(data.errors, function (index, value) {

                        var popover = $('[data-show-error=' + index + ']').show().popover();
                        popover.attr('data-content', value);

                    });

                } else {
                    uploader.start();
                    $('[data-show-error]').hide().popover('destroy');
                    $('.flash').empty().append('Акаунтът е създаден!').fadeIn(500).delay(1000).fadeOut(500);
                    if(uploader.files.length < 1){
                        $.ajax({
                            url: '/accounts/accounts/?page='+$( ".page-users").size(),
                            type: "GET", // not POST, laravel won't allow it
                            success: function(data){
                                $data = $(data); // the HTML content your controller has produced
                                $('.ajax-users-load').html($data);
                            }
                        });
                        $('.panel-body').hide();
                        $('input[name="name"]').val('');
                        $('input[name="email"]').val('');
                        $('input[name="password"]').val('');
                        $('input[name="password_confirmation"]').val('');
                        $('#avatar-upload').empty();
                        $('#multiple-optgroups').multiselect('deselectAll', false);
                        $('#multiple-optgroups').multiselect('updateButtonText');
                    }
                   //$('.panel-body table tbody').append('<tr class="info"><td ><div class="list-image"><img src="/avatar/'+data.id+'" alt="img" class="img"></div></td></tr>')


                }
            }
        });
        e.preventDefault();
    }

    $("form[data-remote-account]").on('submit', submitAjaxAccountCreate);


});