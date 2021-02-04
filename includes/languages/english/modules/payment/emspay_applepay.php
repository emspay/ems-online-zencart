<?php
$file_name = explode('.php',basename(__FILE__))[0];
$prefix = strtoupper(explode("_", $file_name)[0]);

define('MODULE_PAYMENT_'.$prefix.'_ORDER_DESCRIPTION', "Your order %s at %s");

define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_TEXT_TITLE', "Apple Pay");
define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_TEXT_DESCRIPTION', "Payment method is provided by EMS Online.");

define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_DISPLAY_TITLE_TEXT', "Payment method display name");
define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_DISPLAY_TITLE_DESCRIPTION', "Payment method name that will be displayed to the customer.");

define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_STATUS_TEXT', "Enable Apple Pay");
define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_STATUS_DESCRIPTION', "Do you want to enable Apple Pay?");

define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_SORT_ORDER_TEXT', "Sort order for Apple Pay");
define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_SORT_ORDER_DESCRIPTION', "The payment method with the lowest order is displayed first.");

define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_ZONE_TEXT', "Payment Method availability Zone");
define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_ZONE_DESCRIPTION', "If a zone is selected, then this payment method is enabled only for that zone.");

define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_ERROR_TRANSACTION', "There was an error processing your payment. We apologize for the inconvenience. Please choose another payment method.");
define('MODULE_PAYMENT_'.$prefix.'_APPLEPAY_ERROR_ALREADY_INSTALLED', "The Credit Card module is already installed.");
