<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Bancontact payment method
 */
class emspay_bancontact extends gingerPaymentDefault
{
    public $code = 'bancontact';
}
