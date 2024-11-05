(function ($) {
    'use strict';
    var showWireTransferInfo = function () {
        $('input[type=radio][name=payment_method]').on('change', function () {
            if ($(this).val() == 'wire_transfer') {
                $('.wire-transfer-info').show()
            } else {
                $('.wire-transfer-info').hide();
            }
        })
    }

    var handlePaymentInvoice = function () {
        $('#payment_per_package').on('click', function (event) {
            event.preventDefault();
            var paymentMethod = $('input[type=radio][name=payment_method]:checked').val();
            var packageID = $('input[name=package_id]').val();
            switch (paymentMethod) {
                case 'paypal':
                    executePaymentByPaypal(packageID);
                    break;
                case 'wire_transfer':
                    executePaymentByWireTransfer(packageID);
                    break;
                case 'stripe':
                    $('.stripe-payment-form .stripe-checkout-button').trigger('click');
                    break;
                default:
                    break;
            }
        })
    }

    var executePaymentByPaypal = function (packageId) {
        var securityPassword = $('#tfre_security_payment').val();
        $.ajax({
            type: 'post',
            url: payment_variables.ajax_url,
            data: {
                'action': 'tfre_handle_payment_invoice_by_paypal',
                'package_id': packageId,
                'tfre_security_payment': securityPassword
            },
            beforeSend: function () {
                $('#payment_per_package').append(' <i class="fa fa-spinner fa-spin"></i>');
            },
            success: function (data) {
                $('#payment_per_package').children('i').removeClass('fa-spinner fa-spin');
                window.location.href = data;
            },
            error: function (xhr, status, error) {
                // Handle the registration error response
                $('#payment_per_package').children('i').removeClass('fa-spinner fa-spin');
                console.log(error);
            }
        });
    }

    var executePaymentByWireTransfer = function (packageId) {
        var securityPassword = $('#tfre_security_payment').val();
        $.ajax({
            type: 'post',
            url: payment_variables.ajax_url,
            data: {
                'action': 'tfre_handle_payment_invoice_by_wire_transfer',
                'package_id': packageId,
                'tfre_security_payment': securityPassword
            },
            beforeSend: function () {
                $('#payment_per_package').append('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: function (data) {
                $('#payment_per_package').children('i').removeClass('fa-spinner fa-spin');
                window.location.href = data;
            },
            error: function (xhr, status, error) {
                $('#payment_per_package').children('i').removeClass('fa-spinner fa-spin');
                console.log(error);
            }
        });
    }

    var handleFreePackage = function () {
        $('#free_package').on('click', function (e) {
            e.preventDefault();
            var packageID = $('input[name=package_id]').val();
            var securityPassword = $('#tfre_security_payment').val();
            $.ajax({
                type: 'post',
                url: payment_variables.ajax_url,
                data: {
                    'action': 'tfre_handle_free_package',
                    'package_id': packageID,
                    'tfre_security_payment': securityPassword
                },
                beforeSend: function () {
                    $('#payment_per_package').append('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (data) {
                    $('#payment_per_package').children('i').removeClass('fa-spinner fa-spin');
                    window.location.href = data;
                },
                error: function (xhr, status, error) {
                    $('#payment_per_package').children('i').removeClass('fa-spinner fa-spin');
                    console.log(error);
                },
            })
        })
    }

    var executeStripeCheckout = function (packageId = null) {
        var form = $('.stripe-payment-form');
        if (form.length == 0) return;
        var submitFormBtn = form.find('.stripe-checkout-button');
        var formID = form.attr('id');
        var formData = stripe_variables[formID];
        var stripeHandler = null;

        if (submitFormBtn.length) {
            stripeHandler = StripeCheckout.configure({
                key: formData.key,
                token: function (token, args) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'stripeToken',
                        value: token.id
                    }).appendTo(form);

                    $('<input>').attr({
                        type: 'hidden',
                        name: 'stripeTokenType',
                        value: token.type
                    }).appendTo(form);

                    if (token.email) {
                        $('<input>').attr({
                            type: 'hidden',
                            name: 'stripeEmail',
                            value: token.email
                        }).appendTo(form);
                    }
                    form.submit();
                }
            });
            submitFormBtn.on('click', function (event) {
                event.preventDefault();
                stripeHandler.open(formData.data);
            })
        }
        window.addEventListener('popstate', function () {
            if (stripeHandler != null) {
                stripeHandler.close();
            }
        })
    }

    $(document).ready(function () {
        $('.wire-transfer-info').hide();
        executeStripeCheckout();
        showWireTransferInfo();
        handlePaymentInvoice();
        handleFreePackage();
    })
})(jQuery);