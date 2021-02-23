<?php
$file_name = explode('.php',basename(__FILE__))[0];
$prefix = strtoupper(explode("_", $file_name)[0]);

define('NAVBAR_TITLE', 'Traitement de votre commande');
define($prefix.'_PLEASE_WAIT', 'S\'il vous plaît attendre, alors que l\'état de votre commande est en cours de vérification.');
define($prefix.'_ORDER_PROCESSING', 'Votre commande est en cours de traitement.');
define($prefix.'_ORDER_PENDING', 'Nous n\'avons pas encore reçu de confirmation de votre banque ou de votre émetteur de carte.');
define($prefix.'_ORDER_PENDING_MESSAGE', 'Vous recevrez un message dès que nous avons reçu ce.');