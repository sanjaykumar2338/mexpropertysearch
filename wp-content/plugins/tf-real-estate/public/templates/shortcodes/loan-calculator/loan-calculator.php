<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
wp_enqueue_script('loan-calculator')
?>
<div class="loan-calculator-form">
    <div class="col-md-12">
        <div class="form-group">
            <label for="total_amount"><?php esc_html_e('Total Amount', 'tf-real-estate'); ?></label>
            <input type="text" id="total_amount" class="form-control" name="total_amount" value="" placeholder="10,000">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="down_payment"><?php esc_html_e('Down Payment', 'tf-real-estate'); ?></label>
            <input type="text" id="down_payment" class="form-control" name="down_payment" value="" placeholder="3,000">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label
                for="amortization_period"><?php esc_html_e('Amortization Period (months)', 'tf-real-estate'); ?></label>
            <input type="text" id="amortization_period" class="form-control" name="amortization_period" value=""
                placeholder="12">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="interest_rate"><?php esc_html_e('Interest rate (%)', 'tf-real-estate'); ?></label>
            <input type="number" id="interest_rate" class="form-control" name="interest_rate" value="" placeholder="5">
        </div>
    </div>
    <div class="col-md-12">
        <div class="group-calculator">
            <span><?php esc_html_e('Monthly payment: ', 'tf-real-estate'); ?></span>
            <span id="monthly-payment-value"></span>
        </div>
    </div>
</div>