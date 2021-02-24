<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for BankTransfer payment method
 */
class emspay_banktransfer extends gingerPaymentDefault
{
    /**
     * @var string
     */
    public $code = 'banktransfer';

    /**
     * Bank Transfer constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->email_footer = constant(MODULE_PAYMENT_ . strtoupper($this->code) . _INFORMATION_EMAIL);
    }
}
