<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for PayPal payment method
 */
class ginger_paypal extends gingerPaymentDefault
{
    public $code = 'paypal';
}
