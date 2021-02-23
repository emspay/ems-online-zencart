<?php
$file_name = explode('.php',basename(__FILE__))[0];
$prefix = strtoupper(explode("_", $file_name)[0]);

define('NAVBAR_TITLE', 'Uw bestelling verwerken');
define($prefix.'_PLEASE_WAIT', 'Even geduld terwijl uw bestelstatus wordt gecontroleerd.');
define($prefix.'_ORDER_PROCESSING', 'Uw bestelling wordt momenteel verwerkt.');
define($prefix.'_ORDER_PENDING', 'We hebben van uw kaartuitgever of bank nog geen bevestiging ontvangen.');
define($prefix.'_ORDER_PENDING_MESSAGE', 'U ontvangt een bericht zodra wij deze hebben ontvangen.');
