<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Payconiq payment method
 */
class ginger_payconiq extends gingerPaymentDefault
{
    public $code = 'payconiq';
}
