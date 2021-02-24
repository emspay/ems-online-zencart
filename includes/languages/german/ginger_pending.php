<?php
$file_name = explode('.php',basename(__FILE__))[0];
$prefix = strtoupper(explode("_", $file_name)[0]);

define('NAVBAR_TITLE', 'Ihre Bestellung wird bearbeitet');
define($prefix.'_PLEASE_WAIT', 'Bitte warten Sie, während Ihr Bestellstatus überprüft wird.');
define($prefix.'_ORDER_PROCESSING', 'Ihre Bestellung wird gerade bearbeitet.');
define($prefix.'_ORDER_PENDING', 'Wir haben noch keine Bestätigung von Ihrer Bank oder Ihrem Kartenaussteller erhalten.');
define($prefix.'_ORDER_PENDING_MESSAGE', 'Sie erhalten eine Nachricht, sobald wir diese erhalten haben.');
