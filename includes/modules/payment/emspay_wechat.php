<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for WeChat payment method
 */
class emspay_wechat extends gingerPaymentDefault
{
    public $code = 'wechat';
}
