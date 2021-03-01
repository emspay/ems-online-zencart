<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Votre commande %s à %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "WeChat");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Méthode de paiement fournie par EMS Online.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Nom d'affichage de la méthode de paiement");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Nom de la méthode de paiement qui sera affichée au client.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Activer WeChat");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Voulez-vous activer WeChat?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Ordre de tri pour WeChat");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "La méthode de paiement avec l'ordre le plus bas est affiché en premier.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Zone pour la disponibilité de la méthode de paiement");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "Si une zone est sélectionnée, cette méthode de paiement est activée uniquement pour cette zone.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "Il y avait malheureusement un problème traitant votre paiement. Veuillez reessayer le paiement s'il vous plaît.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "Le module Cartes du credit est déjà installé.");
