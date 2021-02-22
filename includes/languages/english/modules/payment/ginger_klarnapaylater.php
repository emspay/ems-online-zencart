<?php
$bank_prefix = $_SESSION['ginger_language_prefix'];
$method_prefix = explode('_',explode('.php',basename(__FILE__))[0])[1];
$method_name = strtoupper(implode('_', [$bank_prefix,$method_prefix]));

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Your order %s at %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Payment method is provided by EMS Online");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Payment method display name");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Payment method name that will be displayed to the customer.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Enable Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Do you want to enable Klarna Pay Later?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sort order for Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "The payment method with the lowest order is displayed first.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Payment Method availability Zone");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "If a zone is selected, then this payment method is enabled only for that zone.");

define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_TEXT', "Test API key");
define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_DESCRIPTION', "Enter the API Key of the test webshop here for testing Klarna Pay Later. If you do not offer Klarna Pay Later you can leave this empty.");

define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_TEXT', "IP address(es) for testing Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_DESCRIPTION', "You can specify specific IP addresses for which Klarna Pay Later is visible, for example if you want to test Klarna Pay Later. You can type IP addresses as 128.0.0.1, 255.255.255.255. If you leave this empty Klarna Pay Later is visible to all IP addresses.");

define('MODULE_PAYMENT_'.$method_name.'_DOB', "Please use the following format for entering the birth date : YYYY-MM-DD, e.g.: 1980-12-31");
define('MODULE_PAYMENT_'.$method_name.'_GENDER', "Please select your gender:");
define('MODULE_PAYMENT_'.$method_name.'_MALE', "Male");
define('MODULE_PAYMENT_'.$method_name.'_FEMALE', "Female");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "There was an error processing your payment. We apologize for the inconvenience. Please choose another payment method.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "The Klarna Pay Later module is already installed.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION_IS_CANCELLED', "Unfortunately, we can not currently accept your purchase with Klarna Pay Later. Please choose another payment option to complete your order. We apologize for the inconvenience.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_GENDER', "You have not selected a gender. Please select the correct gender.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_DOB', "There was an error with the date of birth that you entered. Please use the following format for entering the birth date : YYYY-MM-DD, e.g.: 1980-12-31");
