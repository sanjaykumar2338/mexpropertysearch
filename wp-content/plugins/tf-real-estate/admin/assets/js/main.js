jQuery(document).ready(function ($) {
    $('.colorpicker').wpColorPicker();
    $("#mytabs .hidden").removeClass('hidden');
    $("#mytabs").tabs();

    function inputFloatNumber(selector) {
        $(selector).on('input', function (e) {
            var input = $(this);
            var oldVal = input.val();
            var floatNumberVal = oldVal.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
            input.val(floatNumberVal);
        });
    }

    inputFloatNumber('input#property_price_value');

    $('#reset-option-country').on('click', function (event) {
        event.preventDefault();
        var confirmed = confirm(tfre_main_vars.confirm_reset_text);
        if (confirmed) {
            $.ajax(
                {
                    type: 'POST',
                    url: tfre_main_vars.ajax_url,
                    data: {
                        action: 'tfre_reset_option_country',
                    },
                    success: function (response) {
                        // Handle the registration success response
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        // Handle the registration error response
                        console.log(error);
                    }
                }
            )
        }
    });

    // reorder package detail after title
    if (tfre_main_vars.post_type_now == 'package') {
        $('#postdiv, #postdivrich').appendTo('#package-detail');
    }


    $('#single_property_panels_manager-list #single_property_panels_manager-gallery-hidden').closest('li').addClass('gallery-item');
    $('#single_property_panels_manager-list #single_property_panels_manager-review-hidden').closest('li').addClass('review-item');
    $("#single_property_panels_manager-list").sortable({
        cancel: ".gallery-item, .review-item"
    });


    // Detection if an element is added to DOM
    function onElementInserted(containerSelector, elementSelector, callback) {
        var onMutationsObserved = function (mutations) {
            mutations.forEach(function (mutation) {
                if (mutation.addedNodes.length) {
                    var elements = $(mutation.addedNodes).find(elementSelector);
                    for (var i = 0, len = elements.length; i < len; i++) {
                        callback(elements[i]);
                    }
                }
            });
        };

        var target = $(containerSelector)[0];
        if (!target) {
            // The node target we need does not exist yet.
            // Wait 300ms and try again
            window.setTimeout(onElementInserted, 300);
            return;
        }
        var config = { childList: true, subtree: true };
        var MutationObserver = window.MutationObserver || window.WebKitMutationObserver;
        var observer = new MutationObserver(onMutationsObserved);
        observer.observe(target, config);
    };

    // Set value additional field name
    $('input[name*=additional_field_label]').on('focusout', function () {
        var label = $(this).val(),
            name = label.replace(/[^a-zA-Z 0-9 ]/g, '').replace(/\s+/g, '-').toLowerCase();
        $(this).parent().next().next().find('input[name*=additional_field_name]').val(name);
    });
    onElementInserted('.redux-repeater-accordion', 'input[name*=additional_field_label]', function (e) {
        $('input[name*=additional_field_label]').on('focusout', function () {
            var label = $(this).val(),
                name = label.replace(/[^a-zA-Z 0-9 ]/g, '').replace(/\s+/g, '-').toLowerCase();
            $(this).parent().next().next().find('input[name*=additional_field_name]').val(name);
        });
    });

    // Show input options value when field type is select or radio or type
    $('select[name*=additional_field_type]').each(function (i, el) {
        var fieldType = $(el).val();
        if (fieldType === 'select' || fieldType === 'radio' || fieldType === 'checkbox') {
            $(el).parent('fieldset').next().show();
            $(el).parent('fieldset').next().next().show();
        }
    });

    function onScrollFixedSidebarPluginOption() {
        if (!($(".redux-sidebar").hasClass('redux-sidebar'))) return;
        if ($('.redux-sidebar').hasClass('no-fixed')) return;

        var top = $('.redux-sidebar').offset().top - parseFloat($('.redux-sidebar').css('marginTop').replace(/auto/, 0));
        var footTop = $('.redux-sidebar').next().next('.clear').offset().top - parseFloat($('.redux-sidebar').next().next('.clear').css('marginTop').replace(/auto/, 0));
        var maxY = footTop - $('.redux-sidebar').innerHeight();

        $(window).scroll(function (evt) {
            var y = $(this).scrollTop();
            if (y >= top) {
                if (y <= maxY) {
                    $('.redux-sidebar').addClass('fixed').removeAttr('style').css({
                        top: '32px',
                    });
                } else {
                    $('.redux-sidebar').removeClass('fixed').css({
                        position: 'absolute',
                        top: 'auto',
                        bottom: '0',
                        height: '100vh'
                    });
                }
            } else {
                $('.redux-sidebar').removeClass('fixed');
            }
        });
    }
    onScrollFixedSidebarPluginOption();
});