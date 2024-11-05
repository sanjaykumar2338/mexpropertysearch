jQuery(document).ready(function ($) {
    function ct_media_upload(button_class) {
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;
        $('body').on('click', button_class, function (e) {
            var button_id = '#' + $(this).attr('id');
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(button_id);
            _custom_media = true;
            wp.media.editor.send.attachment = function (props, attachment) {
                if (_custom_media) {
                    $('#property-type-image-id').val(attachment.id);
                    $('#property-type-image-wrapper').html(
                        '<img loading="lazy" class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />'
                    );
                    $('#property-type-image-wrapper .custom_media_image').attr('src', attachment.url)
                        .css('display', 'block');
                } else {
                    return _orig_send_attachment.apply(button_id, [props, attachment]);
                }
            }
            wp.media.editor.open(button);
            return false;
        });
    }
    ct_media_upload('.add_media_button.button');
    $('body').on('click', '.remove_media_button', function () {
        $('#property-type-image-id').val('');
        $('#property-type-image-wrapper').html(
            '<img loading="lazy" class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />'
        );
    });

    $(document).ajaxComplete(function (event, xhr, settings) {
        var queryStringArr = settings.data.split('&');
        if ($.inArray('action=add-tag', queryStringArr) !== -1) {
            var xml = xhr.responseXML;
            $response = $(xml).find('term_id').text();
            if ($response != "") {
                // Clear the thumb image
                $('#property-type-image-wrapper').html('');
            }
        }
    });
});