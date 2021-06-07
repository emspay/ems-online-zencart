<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Your order %s at %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "Bank Transfer");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Payment method is provided by EMS Online");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Enable Bank Transfer");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Do you want to enable Bank Transfer?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sort order for Bank Transfer");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "The payment method with the lowest order is displayed first.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Payment Method availability Zone");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "If a zone is selected, then this payment method is enabled only for that zone.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Payment method display name");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Payment method name that will be displayed to the customer.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "There was an error processing your payment. We apologize for the inconvenience. Please choose another payment method.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "The Bank Transfer module is already installed.");

define('MODULE_PAYMENT_'.$method_name.'_INFORMATION', 'Please use the following information when performing the bank transfer:
<br/> Reference: <b>{{reference}}</b>
<br/> IBAN:  <b>NL13INGB0005300060</b>
<br/> BIC:  <b>INGBNL2A</b>
<br/> Account holder:  <b>EMS Bank N.V. PSP</b>
<br/> City:  <b>Amsterdam</b>
<br/><br/>');

define('MODULE_PAYMENT_'.$method_name.'_INFORMATION_EMAIL', 'Please use the following information for the bank transfer:
Reference: {{reference}}
IBAN: NL79ABNA0842577610
BIC: INGBNL2A
Account holder: EMS Bank N.V. PSP
City: Amsterdam');

define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_TEXT', "Allowed currencies");
define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_DESCRIPTION', "The payment method will be available ONLY for selected currencies. You can manage this list and compare it with currencies that accepting by your shop. <br>If set empty - the shop currencies will be compared with the standard payment provider currencies list. <br> Accepted list format is <i>CODE1,CODE2,CODE3</i> example <i>USD,EUR,UAH</i>.");
