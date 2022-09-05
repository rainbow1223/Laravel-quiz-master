$('#form_view_add_picture').click(function () {
    $('#form_view_input_media_element').trigger('click');
});

function change_media_pic() {
    $('#form_view_input_media_element').trigger('click');
}

function delete_media_pic() {
    $('.slide_option').show();
    $('.picture_properties').hide();
    $('#form_view_add_picture').show();
    $('#form_view_add_video').show();
    $('#form_view_media_element').hide();
    $('#media').val('');
    $('#media_element').val('');
    $('#quiz_view .slide_view_media_element').remove();
    $('#quiz_view #quiz_background_container').append('<div class="slide_view_media_element slide_view_group" style="z-index: 3;display: none;position: absolute;top: 0;left: 0;"><img src="#" alt="slide_view_media" style="width: 100%;height: 100%;"></div>');
}

function show_pic_properties() {
    $('.slide_option').hide();
    $('.picture_properties').show();
    $('#picture_properties_image img').attr('src', $('#form_view_media_element').attr('src'));
}

function close_pic_properties() {
    $('.slide_option').show();
    $('.picture_properties').hide();
}

$('#form_view_input_media_element').change(function () {

    var root_url = $('meta[name=url]').attr('content');

    let reader = new FileReader();

    reader.onload = (e) => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let formData = new FormData();
        formData.append('image', e.target.result);
        formData.append('quiz_id', $("#quiz_id").val());

        show_preload();
        $.ajax({
            type: 'POST',
            url: root_url + '/hotspots_image_upload',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    console.log(response);
                    $('#media').val(root_url + '/' + response);
                    $('#quiz_view .slide_view_media_element img').attr('src', root_url + '/' + response);
                    $('#quiz_view .slide_view_media_element').show();
                    $('#media_element').val($('#quiz_view .slide_view_media_element')[0].outerHTML);
                    console.log('Image has been uploaded successfully');
                }
                hide_preload();
            },
            error: function (response) {
                console.log(response);
                hide_preload();
                // $('#image-input-error').text(response.responseJSON.errors.file);
            }
        });

        $('#form_view_media_element').attr('src', e.target.result);
        $('#picture_properties_image img').attr('src', e.target.result);
        $('#form_view_add_picture').hide();
        $('#form_view_add_video').hide();
        $('#form_view_media_element').show();
    }

    reader.readAsDataURL(this.files[0]);
    $('#form_view_input_media_element').val('');

});

/*
*          Quiz background Image
* */

$('#format_bg_btn').click(function () {
    $('.background_properties').show();

    if ($('#background_properties_image img').attr('src') == '') {
        $('#change_background_tag').html('Open');
    }

    $('.slide_option').hide();
});

function change_background_pic() {
    $('#select_background_img').trigger('click');
}

function close_background_properties() {
    $('.background_properties').hide();
    $('.slide_option').show();
}

function apply_all() {
    const root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');
    const background_img = $('#background_img').val();
    const exam_id = $('#exam_id').val();

    show_preload();
    $.ajax({
        url: root_url + '/bg_apply_all',
        type: 'POST',
        data: {
            _token: token,
            exam_id: exam_id,
            background_img: background_img,
        },
        success: function (data) {
            show_modal('success', 'Success', 'Background of All Questions updated successfully');
            $('.preview_item > div > div').css('background-image', background_img);
            hide_preload();
            set_flag_true();
        }
    }).catch((XHttpResponse) => {
        console.log(XHttpResponse);
        hide_preload();
    });
}

function delete_background_pic() {
    $('#bg_delete_confirm_dialog').fadeIn(300);
}

$('#bg_delete_yes').click(function () {
    $('#quiz_view #quiz_background_container').css('background-image', 'unset');
    $('#background_properties_image img').attr('src', '');
    $('#background_img').val('');
    $('#change_background_tag').html('Open');
    $('#bg_delete_confirm_dialog').fadeOut(300);
    set_flag_true();
});

$('#bg_delete_no').click(function () {
    $('#bg_delete_confirm_dialog').fadeOut(300);
});

$('#select_background_img').change(function () {

    var root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');

    let reader = new FileReader();

    reader.onload = (e) => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let formData = new FormData();
        formData.append('image', e.target.result);
        formData.append('quiz_id', $("#quiz_id").val());

        show_preload();
        $.ajax({
            type: 'POST',
            url: root_url + '/hotspots_image_upload',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {

                    $('#quiz_view #quiz_background_container').css('background-image', 'url("' + root_url + '/' + response + '")');
                    $('#background_properties_image img').attr('src', root_url + '/' + response);
                    $('#background_img').val('url("' + root_url + '/' + response + '")');
                    $('#change_background_tag').html('Change');
                    console.log('Image has been uploaded successfully');

                    set_flag_true();
                }
                hide_preload();
            },
            error: function (response) {
                console.log(response);
                hide_preload();
                // $('#image-input-error').text(response.responseJSON.errors.file);
            }
        });

    }

    reader.readAsDataURL(this.files[0]);

    $('#select_background_img').val('');
});

/*
* ************ Add & Upload Video **************
* */

$('#form_view_add_video').click(function () {
    $('#form_view_input_video_element').trigger('click');
});

$('#form_view_input_video_element').change(function () {
    // $('#form_view_upload_video').submit();
    var root_url = $('meta[name=url]').attr('content');
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    var files = $('#form_view_input_video_element')[0].files;

    if (files.length > 0) {
        var fd = new FormData();

        // Append data
        fd.append('file', files[0]);
        fd.append('_token', CSRF_TOKEN);

        // Hide alert
        $('#responseMsg').hide();

        show_preload();
        // AJAX request
        $.ajax({
            url: root_url + '/upload_video',
            method: 'post',
            data: fd,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {


                if (response.success == 1) { // Uploaded successfully

                    console.log(response.filepath);
                    $('#video').val(response.filepath);
                    $('#video_properties_video source').attr('src', $('#video').val()).appendTo($('#video_properties_video source').parent());
                    $('#video_properties_video video')[0].load();
                    console.log($('.slide_view_video_element video source'));
                    $('#quiz_view .slide_view_video_element video source').attr('src', $('#video').val()).appendTo($('#quiz_view .slide_view_video_element video'));
                    $('#quiz_view .slide_view_video_element').show();
                    $('#quiz_view .slide_view_video_element video')[0].load();

                    $('#form_view_add_picture').hide();
                    $('#form_view_add_video').hide();
                    $('#form_view_video_element').show();
                } else if (response.success == 2) { // File not uploaded

                    // Response message
                    $('#responseMsg').removeClass("alert-success");
                    $('#responseMsg').addClass("alert-danger");
                    $('#responseMsg').html(response.message);
                    $('#responseMsg').show();
                } else {
                    // Display Error
                    $('#err_file').text(response.error);
                    $('#err_file').removeClass('d-none');
                    $('#err_file').addClass('d-block');
                }
                hide_preload();
            },
            error: function (response) {
                console.log("error : " + JSON.stringify(response));
                hide_preload();
            }
        });
    } else {
        alert("Please select a file.");
    }

    $('#form_view_input_video_element').val('');
});

function show_video_properties() {
    $('.slide_option').hide();
    $('.video_properties').show();
    // $('#video_properties_video source').attr('src', $('#video').val()).appendTo($('#video_properties_video source').parent());

}

function close_video_properties() {
    $('.slide_option').show();
    $('.video_properties').hide();
}

function change_video() {
    $('#form_view_input_video_element').trigger('click');
}

function delete_video() {
    $('.slide_option').show();
    $('.video_properties').hide();
    $('#form_view_add_picture').show();
    $('#form_view_add_video').show();
    $('#form_view_video_element').hide();
    $('#video').val('');
    $('#quiz_view .slide_view_video_element').remove();
    $('#quiz_view #quiz_background_container').append('<div class="slide_view_video_element slide_view_group" style="z-index: 3;display: none;position: absolute;top: 0;left: 0;"><video controls style="height: 100%;width: 100%;"><source src="#"></video></div>');
}

/*
* *************** Add Audio
* */
$('#form_view_add_audio').click(function () {
    $('#form_view_input_audio_element').trigger('click');
});

$('#form_view_input_audio_element').change(function () {
    console.log('changed');
    var root_url = $('meta[name=url]').attr('content');
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    var files = $('#form_view_input_audio_element')[0].files;

    if (files.length > 0) {
        var fd = new FormData();

        // Append data
        fd.append('file', files[0]);
        fd.append('_token', CSRF_TOKEN);

        // Hide alert
        $('#responseMsg').hide();

        show_preload();
        // AJAX request
        $.ajax({
            url: root_url + '/upload_audio',
            method: 'post',
            data: fd,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {


                if (response.success == 1) { // Uploaded successfully

                    console.log(response);
                    $('#form_view_add_audio').hide();
                    $('#form_view_audio_mark').show();
                    $('#audio').val(response.filepath);
                    $('#audio_properties source').attr('src', $('#audio').val()).appendTo($('#audio_properties source').parent());
                    var audio = $('#audio_properties audio');
                    audio[0].pause();
                    audio[0].load();//suspends and restores all audio element

                    //audio[0].play(); changed based on Sprachprofi's comment below
                    audio[0].oncanplaythrough = audio[0].play();

                } else if (response.success == 2) { // File not uploaded

                    // Response message
                    $('#responseMsg').removeClass("alert-success");
                    $('#responseMsg').addClass("alert-danger");
                    $('#responseMsg').html(response.message);
                    $('#responseMsg').show();
                } else {
                    // Display Error
                    $('#err_file').text(response.error);
                    $('#err_file').removeClass('d-none');
                    $('#err_file').addClass('d-block');
                }
                hide_preload();
            },
            error: function (response) {
                console.log("error : " + JSON.stringify(response));
                hide_preload();
            }
        });
    } else {
        alert("Please select a file.");
    }
    $('#form_view_input_audio_element').val('');
});

$('#form_view_audio_mark').click(function () {
    $('.audio_properties').show();
    $('.slide_option').hide();
    // $('#audio_properties source').attr('src', $('#audio').val()).appendTo($('#audio_properties source').parent());
    // var audio = $('#audio_properties audio');
    // audio[0].pause();
    // audio[0].load();//suspends and restores all audio element
    //
    // //audio[0].play(); changed based on Sprachprofi's comment below
    // audio[0].oncanplaythrough = audio[0].play();
    // $('#audio_properties audio')[0].load();
});

function change_audio() {
    $('#form_view_input_audio_element').trigger('click');
}

function delete_audio() {
    close_audio_properties();
    $('#audio').val('');
    $('#audio_properties source').attr('src', $('#audio').val()).appendTo($('#audio_properties source').parent());
    $('#form_view_add_audio').show();
    $('#form_view_audio_mark').hide();
}

function close_audio_properties() {
    $('.audio_properties').hide();
    $('.slide_option').show();
}

function upload_blob(blob) {
    console.log(blob);
}
