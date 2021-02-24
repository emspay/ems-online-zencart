<?php
$file_name = explode('.php',basename(__FILE__))[0];
$prefix = strtoupper(explode("_", $file_name)[0]);

define('NAVBAR_TITLE', 'Processing your order');
define($prefix.'_PLEASE_WAIT', 'Please wait while your order status is being checked...');
define($prefix.'_ORDER_PROCESSING', 'Your order is currently being processed.');
define($prefix.'_ORDER_PENDING', 'We did not receive a confirmation from your bank or card issuer.');
define($prefix.'_ORDER_PENDING_MESSAGE', 'You will receive a message as soon as we have received this.');