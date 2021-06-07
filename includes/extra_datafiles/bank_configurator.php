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
    'wechat' => 'wechat',
    'googlepay' => 'google-pay'
]);

define('GINGER_AVAILABLE_CURRENCIES', [
    'afterpay' => ['EUR', 'NOK', 'SEK', 'DKK', 'CHF'],
    'applepay' => ['AUD', 'CHF', 'CAD', 'EUR', 'GBP', 'HKD', 'SGD', 'USD'],
    'bancontact' => 'EUR',
    'banktransfer' => 'EUR',
    'creditcard' => ['EUR', 'GBP', 'USD', 'CAD', 'CHF', 'CZK', 'DKK', 'NOK', 'PLN', 'SEK', 'AUD', 'HKD', 'JPY', 'NZD', 'SGD', 'ZAR', 'BRL', 'TRY'],
    'ideal' => 'EUR',
    'klarnapaylater' => ['EUR', 'DKK', 'NOK', 'SEK', 'CHF', 'GBP', 'USD', 'AUD'],
    'klarnapaynow' => ['EUR', 'DKK', 'NOK', 'SEK', 'CHF', 'GBP', 'USD', 'AUD'],
    'payconiq' => 'EUR',
    'paypal' => ['AUD', 'CAD', 'CHF', 'CZK', 'DKK', 'EUR', 'GBP', 'HKD', 'NOK', 'PLN', 'SEK', 'SGD', 'USD'],
    'amex' => ['AUD', 'CHF', 'DKK', 'EUR', 'GBP', 'HKD', 'JPY', 'NOK', 'NZD', 'SEK', 'SGD', 'USD'],
    'tikkiepaymentrequest' => 'EUR',
    'wechat' => ['EUR', 'USD', 'CNY', 'AUD', 'CAD', 'GBP', 'HKD', 'JPY', 'NZD', 'SGD', 'THB', 'KRW', 'RUB', 'DKK', 'SEK', 'CHF', 'NOK'],
    'googlepay' => 'EUR'
]);