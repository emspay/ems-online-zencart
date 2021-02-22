<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for Tikkie Payment Request payment method
 */
class emspay_tikkiepaymentrequest extends gingerPaymentDefault
{
    public $code = 'tikkiepaymentrequest';
}
