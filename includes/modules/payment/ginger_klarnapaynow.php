<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Klarna Pay Now payment method
 */
class ginger_klarnapaynow extends gingerPaymentDefault
{
    public $code = 'klarnapaynow';
}
