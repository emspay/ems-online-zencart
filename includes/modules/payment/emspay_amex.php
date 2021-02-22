<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for American Express payment method
 */
class emspay_amex extends gingerPaymentDefault
{
    public $code = 'amex';
}
