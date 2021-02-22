<?php
$bank_prefix = $_SESSION['ginger_language_prefix'];
$method_prefix = explode('_',explode('.php',basename(__FILE__))[0])[1];
$method_name = strtoupper(implode('_', [$bank_prefix,$method_prefix]));

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Your order %s at %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "American Express");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Payment method is provided by EMS Online.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Payment method display name");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Payment method name that will be displayed to the customer.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Enable American Express");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Do you want to enable American Express?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sort order for American Express");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "The payment method with the lowest order is displayed first.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Payment Method availability Zone");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "If a zone is selected, then this payment method is enabled only for that zone.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "There was an error processing your payment. We apologize for the inconvenience. Please choose another payment method.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "The Credit Card module is already installed.");
