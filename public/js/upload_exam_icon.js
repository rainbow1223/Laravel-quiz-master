$('#upload_exam_icon_btn').click(function() {
    $('#upload_exam_icon').trigger('click');
});

$('#upload_exam_icon').change(function () {
    
    var root_url = $('meta[name=url]').attr('content');
    
    let reader = new FileReader();
    
    console.log('changed upload_exam icon');
    reader.onload = (e) => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let formData = new FormData();
        formData.append('image', e.target.result);
        console.log(e.target.result);

        $('#upload_exam_icon_btn').html('Uploading...');
        
        $.ajax({
            type: 'POST',
            url: root_url + '/hotspots_image_upload',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    console.log(response);
                    $('#exam_icon').val(root_url + '/' + response);
                    console.log('Image has been uploaded successfully');
                }
                $('#upload_exam_icon_btn').html('Upload Exam Icon');
            },
            error: function (response) {
                console.log(response);
                $('#upload_exam_icon_btn').html('Upload Exam Icon');
            }
        });
    }

    reader.readAsDataURL(this.files[0]);
});