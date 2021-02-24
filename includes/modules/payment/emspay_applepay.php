<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Apple Pay payment method
 */
class emspay_applepay extends gingerPaymentDefault
{
    public $code = 'applepay';
}
