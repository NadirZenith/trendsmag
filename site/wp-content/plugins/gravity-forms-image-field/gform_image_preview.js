jQuery(document).ready(function($) {
    var nz_gform_image_preview_id, nz_gform_image_preview_type;
    $('.gform_wrapper').on('click', '.nz-upload-button', selectFile);
    /*$('.gform_wrapper').on('click', '.nz-upload-button, .gform_image_preview', selectFile);*/
    createForm();
    function selectFile(e) {

        nz_gform_image_preview_id = e.target.id.replace('-button', '');
        nz_gform_image_preview_type = $(e.target).data('type');
        switch (nz_gform_image_preview_type) {
            case 'multiple':
                $("#fileUploadInput").attr('multiple', 'true');
                break;

            default:
                $("#fileUploadInput").removeAttr('multiple');

        }

        $btn = $("#fileUploadInput");
        $btn.click();
    }

    function createForm() {
        if (document.getElementById("fileUploadForm")) {
            return;
        }

        var $form = $('<form>', {
            'action': ajaxurl,
            'method': 'POST',
            'id': 'fileUploadForm',
            'enctype': 'multipart/form-data'
        }).append($('<input>', {//wp ajax action
            'type': 'text',
            'name': 'action',
            'value': 'nz_gform_image_upload'
        })).append($('<input>', {//input for files
            'type': 'file',
            'name': 'files[]',
            'accept': 'image/*',
            'id': 'fileUploadInput'
        })).append($('<input>', {
            'type': 'submit',
            'id': 'fileUploadSubmit',
            'value': 'submit'
        }));

        var $formContainer = $('<div></div>', {css: {'position': 'absolute', 'top': '-500px'}}).appendTo('body');
        $formContainer.append($form);

        /*$("#fileUploadInput").on('change', sendForm);*/
        $("#fileUploadInput").on('change', function() {
            sendForm(this);
        });

    }

    function sendForm(input) {
        readURL(input);

        var bar = $('#preview-' + nz_gform_image_preview_id + ' .bar');
        var prc = $('#preview-' + nz_gform_image_preview_id + ' .prc');
        var result_pannel = $('#preview-' + nz_gform_image_preview_id + ' .result_pannel');
        /*var percent = $('.percent');*/
        var options = {
            success: showResponse,
            uploadProgress: function(event, position, total, percentComplete) {
                result_pannel.css('display', 'block');
                var percentVal = percentComplete - 1 + '%';
                /*console.log(percentVal);*/

                bar.width(percentVal);
                prc.html(percentVal);
                /*$('#nz-gform-image-preview-' + nz_gform_image_preview_id).css('opacity', percentVal);*/
            }
        };

        $('#fileUploadForm').ajaxForm(options);
        $('#fileUploadSubmit').click();
    }

    function showResponse(responseText, statusText, xhr, $form) {
        $('#' + nz_gform_image_preview_id).val(responseText);
        var response = $.parseJSON(responseText);
        switch (nz_gform_image_preview_type) {
            case 'multiple':
                preview_container = $('#preview-' + nz_gform_image_preview_id);
                /*console.log(response);*/
                $.each(response, function(index, value) {
                    /*console.log(index);*/
                    console.log(value);
                    $('<img/>', {'src': value.src}).appendTo(preview_container);
                });

                break;

            default:
                console.log('response', response);
                $('#nz-gform-image-preview-' + nz_gform_image_preview_id).attr('src', response[1].src).delay('300').one('load', function() {
                    $('#preview-' + nz_gform_image_preview_id + ' .result_pannel').css('display', 'none');
                    $(this).css('opacity', 1);
                });

        }

    }

    function finish() {

    }
    function readURL(input) {
        if (input.files && input.files[0]) {

            try {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#nz-gform-image-preview-' + nz_gform_image_preview_id).attr('src', e.target.result).css('opacity', 0.2);
                    /*$('#nz-gform-image-preview-' + nz_gform_image_preview_id).attr('src', e.target.result).css('opacity', 0.5);*/
                }

                reader.readAsDataURL(input.files[0]);
            } catch (e) {
                console.log(e.message);
            }

        }
    }


});