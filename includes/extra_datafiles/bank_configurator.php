<?php

/**
 * Prefix for Bank functionality.
 */
define('GINGER_BANK_PREFIX','emspay');

/**
 *  Ginger Endpoint
 */

define('GINGER_BANK_ENDPOINT','https://api.online.emspay.eu');

/**
 *
 */
define('GINGER_DEFAULT_LANGUAGE','english');

/**
 * Mapping statuses from Platform to EMS API
 */
define('GINGER_PAYMENT_MAPPING',[
    'afterpay' => 'afterpay',
    'applepay' => 'apple-pay',
    'bancontact' => 'bancontact',
    'banktransfer' => 'bank-transfer',
    'creditcard' => 'credit-card',
    'ideal' => 'ideal',
    'klarnapaylater' => 'klarna-pay-later',
    'klarnapaynow' => 'klarna-pay-now',
    'payconiq' => 'payconiq',
    'paypal' => 'paypal',
    'amex' => 'amex',
    'tikkiepaymentrequest' => 'tikkie-payment-request',
    'wechat' => 'wechat'
]);
