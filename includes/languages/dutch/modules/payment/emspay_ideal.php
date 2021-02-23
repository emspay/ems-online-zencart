<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Uw bestelling %s bij %s");
define('MODULE_PAYMENT_'.$method_name.'_ISSUER_SELECT', "Selecteer uw bank aub:");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "iDEAL");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Betaalmethode verstrekt door EMS PSP.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Betaalmethode weergavenaam");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Naam van betaalmethode die aan de klant wordt getoond.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Schakel iDeal module in");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Wilt u die iDeal module inschakelen?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sorteervolgorde voor iDeal");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "De betaalmethode met de laagste volgorde wordt als eerste weergegeven.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Zone voor betaalmethode beschikbaarheid");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "Als een zone is geselecteerd, dan is deze betaalmethode alleen voor die zone ingeschakeld.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "Helaas is er een fout opgetreden tijdens het verwerken van uw betaling. Probeer het alstublieft nogmaals.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "De iDeal module is al geïnstalleerd.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ISSUER', "Kies een iDEAL uitgevende bank.");
