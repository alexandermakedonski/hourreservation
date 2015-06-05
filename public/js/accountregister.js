$(document).ready(function () {
    var uploader = new plupload.Uploader({
        runtimes: 'html5,flash',
        browse_button: 'avatar-upload',
        drop_element: "avatar-upload",
        max_file_count: 1,
        chunk_size: '50kb',
        url: '/auth/avatar',
        dragdrop: true,
        multi_selection: false,
        flash_swf_url: '/js/vendor/plupload/Moxie.swf',
        silverlight_xap_url: '/js/vendor/plupload/Moxie.xap',
        headers: {'X-CSRF-Token': $('input[name="_token"]').val()},
        filters: {
            max_file_size: '2mb',
            mime_types: [
                {title: "Image files", extensions: "jpg,gif,png,jpeg"}
            ]
        }
    });
    uploader.init();
    uploader.bind('FilesAdded', function(up, files) {
        $('#avatar-upload').empty();
        $.each(files, function(){

            var img = new mOxie.Image();

            img.onload = function() {
                this.embed($('#avatar-upload').get(0), {
                    width: 100,
                    height: 100,
                    crop: true
                });
            };

            img.onembedded = function() {
                this.destroy();
            };

            img.onerror = function() {
                this.destroy();
            };

            img.load(this.getSource());

        });
    });
    uploader.bind('FileUploaded',function(up, file, info){
        $.ajax({
            type: 'POST',
            url: '/auth/regfinal',
            data: {_token:_token,email:$('input[name="email"]').val()},
            success:function(data){
            }
        });
    });

    var submitAjaxAccountCreate = function (e){
        var form = $(this);
        data = form.serialize();
        $.ajax({
            type: 'POST',
            url: form.prop('action'),
            data: data,
            success:function(data){
                if(data.fail){


                    $('[data-show-error]').hide().popover('hide');

                    $.each(data.errors, function( index, value ) {

                        var popover =  $('[data-show-error='+index+']').show().popover();
                        popover.attr('data-content', value);

                    });

                }else{
                    uploader.start();
                    $('[data-show-error]').hide().popover('destroy');
                    $('.flash').empty().append('Аккаънтът е създаден!').fadeIn(500).delay(1000).fadeOut(500);
                    $('.panel-body').hide();
                    $('input[name="name"]').val('');
                    $('input[name="email"]').val('');
                    $('input[name="password"]').val('');
                    $('input[name="password_confirmation"]').val('');
                    $('#avatar-upload').empty();
                    $('#example-multiple-optgroups').multiselect('deselectAll', false);
                    $('#example-multiple-optgroups').multiselect('updateButtonText');
                }
            }
        });
        e.preventDefault();
    }

    $("form[data-remote-account]").on('submit',submitAjaxAccountCreate);

});