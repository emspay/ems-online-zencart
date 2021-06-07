<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Your order %s at %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Payment method is provided by EMS Online");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Payment method display name");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Payment method name that will be displayed to the customer.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Enable AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Do you want to enable AfterPay?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sort order for AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "The payment method with the lowest order is displayed first.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Payment Method availability Zone");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "If a zone is selected, then this payment method is enabled only for that zone.");

define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_TEXT', "Test API key");
define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_DESCRIPTION', "Enter the API Key of the test webshop here for testing AfterPay. If you do not offer AfterPay you can leave this empty.");

define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_TEXT', "IP address(es) for testing AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_DESCRIPTION', "You can specify specific IP addresses for which AfterPay is visible, for example if you want to test AfterPay. You can type IP addresses as 128.0.0.1, 255.255.255.255. If you leave this empty AfterPay is visible to all IP addresses.");

define('MODULE_PAYMENT_'.$method_name.'_DOB', "Please use the following format for entering the birth date : YYYY-MM-DD, e.g.: 1980-12-31");
define('MODULE_PAYMENT_'.$method_name.'_GENDER', "Please select your gender:");
define('MODULE_PAYMENT_'.$method_name.'_MALE', "Male");
define('MODULE_PAYMENT_'.$method_name.'_FEMALE', "Female");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "There was an error processing your payment. We apologize for the inconvenience. Please choose another payment method.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "The AfterPay module is already installed.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION_IS_CANCELLED', "We are sorry to inform you that your request to pay afterwards cannot be accepted by Afterpay. This could have been caused by various (temporary) reasons. If you have any questions pertaining to your rejection, please contact the Afterpay Customer Service via link https://www.afterpay.nl/en/customers/contact or by phone via +31 20 72 30 270. We advise you to select another payment method to complete the payment of your order.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_GENDER', "You have not selected a gender. Please select the correct gender.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_DOB', "There was an error with the date of birth that you entered. Please use the following format for entering the birth date : YYYY-MM-DD, e.g.: 1980-12-31");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_TERMS_AND_CONDITIONS', "Please accept Afterpay Terms & Conditions");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_COUNTRY_IS_NOT_VALID', "Unfortunately, you cannot use AfterPay as Afterpay is only available for addresses in the Netherlands and Belgium. Please use the correct address or select another payment method.");

define('MODULE_PAYMENT_'.$method_name.'_I_ACCEPT', "I accept AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_TERMS_AND_CONDITIONS', "Terms & Conditions");

define('MODULE_PAYMENT_'.$method_name.'_COUNTRIES_AVAILABLE_TEXT', "Countries available for AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_COUNTRIES_AVAILABLE_DESCRIPTION', "To allow AfterPay to be used for any other country just add its country code (in ISO 2 standard) to the 'Countries available for AfterPay' field. <br> Example: BE, NL, FR <br> If field is empty then AfterPay will be available for all countries.");

define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_TEXT', "Allowed currencies");
define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_DESCRIPTION', "The payment method will be available ONLY for selected currencies. You can manage this list and compare it with currencies that accepting by your shop. <br>If set empty - the shop currencies will be compared with the standard payment provider currencies list. <br> Accepted list format is <i>CODE1,CODE2,CODE3</i> example <i>USD,EUR,UAH</i>.");