<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Your order %s at %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "Payconiq");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Payment method is provided by EMS Online.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Payment method display name");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Payment method name that will be displayed to the customer.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Enable Payconiq");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Do you want to enable Payconiq?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sort order for Payconiq");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "The payment method with the lowest order is displayed first.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Payment Method availability Zone");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "If a zone is selected, then this payment method is enabled only for that zone.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "There was an error processing your payment. We apologize for the inconvenience. Please choose another payment method.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "The Payconiq module is already installed.");

define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_TEXT', "Allowed currencies");
define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_DESCRIPTION', "The payment method will be available ONLY for selected currencies. You can manage this list and compare it with currencies that accepting by your shop. <br>If set empty - the shop currencies will be compared with the standard payment provider currencies list. <br> Accepted list format is <i>CODE1,CODE2,CODE3</i> example <i>USD,EUR,UAH</i>.");
