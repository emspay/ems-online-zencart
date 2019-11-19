<?php

define('MODULE_PAYMENT_INGPSP_ORDER_DESCRIPTION', "Your order %s at %s");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_TEXT_TITLE', "Bank Transfer");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_TEXT_DESCRIPTION', "Payment method is provided by ING PSP");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_STATUS_TEXT', "Enable Bank Transfer");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_STATUS_DESCRIPTION', "Do you want to enable Bank Transfer?");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_SORT_ORDER_TEXT', "Sort order for Bank Transfer");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_SORT_ORDER_DESCRIPTION', "The payment method with the lowest order is displayed first.");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_ZONE_TEXT', "Payment Method availability Zone");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_ZONE_DESCRIPTION', "If a zone is selected, then this payment method is enabled only for that zone.");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_DISPLAY_TITLE_TEXT', "Payment method display name");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_DISPLAY_TITLE_DESCRIPTION', "Payment method name that will be displayed to the customer.");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_ERROR_TRANSACTION', "There was an error processing your payment. We apologize for the inconvenience. Please choose another payment method.");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_ERROR_ALREADY_INSTALLED', "The Bank Transfer module is already installed.");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_INFORMATION', 'Please use the following information when performing the bank transfer:
<br/> Reference: <b>{{reference}}</b>
<br/> IBAN:  <b>NL13INGB0005300060</b>
<br/> BIC:  <b>INGBNL2A</b>
<br/> Account holder:  <b>ING Bank N.V. PSP</b>
<br/> City:  <b>Amsterdam</b>
<br/><br/>');

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_INFORMATION_EMAIL', 'Please use the following information for the bank transfer:
Reference: {{reference}}
IBAN: NL13INGB0005300060
BIC: INGBNL2A
Account holder: ING Bank N.V. PSP
City: Amsterdam');
