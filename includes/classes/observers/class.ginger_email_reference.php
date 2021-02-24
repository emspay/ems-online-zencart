<?php

class ginger_email_reference extends base
{
    function __construct()
    {
        $this->attach($this, array('NOTIFY_ORDER_INVOICE_CONTENT_READY_TO_SEND'));
    }

    function update(&$class, $eventID, $one, &$email_order, $html_msg)
    {
        $email_order = str_replace('{{reference}}', $_SESSION[GINGER_BANK_PREFIX.'_banktransfer_reference'], $email_order);
    }
}
