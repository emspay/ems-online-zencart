<?php
$file_name = explode('.php',basename(__FILE__))[0];
$prefix = strtoupper($file_name);

define('MODULE_PAYMENT_'.$prefix.'_TEXT_TITLE', "EMS Online");
define('MODULE_PAYMENT_'.$prefix.'_TEXT_DESCRIPTION', "The official EMS Online ZenCart plugin.");

define('MODULE_PAYMENT_'.$prefix.'_STATUS_TEXT', "Enable EMS Online module.");
define('MODULE_PAYMENT_'.$prefix.'_STATUS_DESCRIPTION', "Do you want to enable EMS Online ZenCart Module?");

define('MODULE_PAYMENT_'.$prefix.'_API_KEY_TEXT', "EMS Online API Key");
define('MODULE_PAYMENT_'.$prefix.'_API_KEY_DESCRIPTION', "Please enter your EMS Online API key from merchant portal.");

define('MODULE_PAYMENT_'.$prefix.'_BUNDLE_CA_TEXT', "Use cURL CA bundle");
define('MODULE_PAYMENT_'.$prefix.'_BUNDLE_CA_DESCRIPTION', "Resolves issue when curl.cacert path is not set in PHP.ini");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_COMPLETED_TEXT', "Status for a completed order");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_COMPLETED_DESCRIPTION', "Select the status from the list that you wish to map to the completed orders.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PENDING_TEXT', "Status for a pending orders.");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PENDING_DESCRIPTION', "Select the status from the list that you wish to map to the pending orders.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_ERROR_TEXT', "Status for an error order");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_ERROR_DESCRIPTION', "Select the status from the list that you wish to map to the orders when they have an error.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PROCESSING_TEXT', "Status for an order being processed");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_PROCESSING_DESCRIPTION', "Select the status from the list that you wish to map to the orders being processed.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_CANCELLED_TEXT', "Status for a cancelled order");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_CANCELLED_DESCRIPTION', "Select the status from the list that you wish to map to the cancelled orders.");

define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_SHIPPED_TEXT', "Status for a captured/shipped order");
define('MODULE_PAYMENT_'.$prefix.'_ORDER_STATUS_SHIPPED_DESCRIPTION', "Select the status from the list that you wish to map to the captured/shipped orders.");

define('MODULE_PAYMENT_'.$prefix.'_ERROR_API_KEY', "The API Key has not been set. Please enter a valid API Key.");
define('MODULE_PAYMENT_'.$prefix.'_ERROR_TRANSACTION', "There was an error processing your payment. We apologize for the inconvenience. Please choose another payment method.");
define('MODULE_PAYMENT_'.$prefix.'_ERROR_ALREADY_INSTALLED', "The EMS Online module is already installed.");
