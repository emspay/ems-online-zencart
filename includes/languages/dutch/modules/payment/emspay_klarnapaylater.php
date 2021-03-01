<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Uw bestelling %s bij %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Betaalmethode verstrekt door EMS PSP.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Betaalmethode weergavenaam");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Naam van betaalmethode die aan de klant wordt getoond.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Schakel Klarna Pay Later module in");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Wilt u die Klarna Pay Later module inschakelen?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sorteervolgorde voor Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "De betaalmethode met de laagste volgorde wordt als eerste weergegeven.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Zone voor betaalmethode beschikbaarheid");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "Als een zone is geselecteerd, dan is deze betaalmethode alleen voor die zone ingeschakeld.");

define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_TEXT', "Test API key");
define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_DESCRIPTION', "Vul hier de API Key in van uw test webshop. Dit is alleen van toepassing voor Klarna Pay Later. Gebruikt u Klarna Pay Later niet dan kunt u dit leeglaten.");

define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_TEXT', "IP adressen voor het testen van Klarna Pay Later:");
define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_DESCRIPTION', "U kunt specifieke IP adressen opgeven waarvoor de Klarna Pay Later betaalmethode zichtbaar is, bv als u wilt testen (bijvoorbeeld: 128.0.0.1, 255.255.255.255). Vult u niets in dan is de betaalmethode voor alle IP adressen zichtbaar.");

define('MODULE_PAYMENT_'.$method_name.'_DOB', "Gebruik het volgende formaat voor het invoeren van de geboortedatum: JJJJ - MM - DD, bijv: 1980-12-31");
define('MODULE_PAYMENT_'.$method_name.'_GENDER', "Selecteer alstublieft uw geslacht:");
define('MODULE_PAYMENT_'.$method_name.'_MALE', "Man");
define('MODULE_PAYMENT_'.$method_name.'_FEMALE', "Vrouw");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "Helaas is er een fout opgetreden tijdens het verwerken van uw betaling. Probeer het alstublieft nogmaals.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "De Klarna Pay Later module is al geïnstalleerd.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION_IS_CANCELLED', "Helaas kunnen we uw aankoop bij Klarna Pay Later momenteel niet accepteren. Kies een andere betalingsoptie om uw bestelling te voltooien. Onze excuses voor het ongemak.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_GENDER', "U hebt geen geslacht geselecteerd. Selecteer het juiste geslacht.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_DOB', "Er is een fout opgetreden met de geboortedatum die u heeft opgegeven. Gebruik het volgende formaat voor het invoeren van de geboortedatum: JJJJ - MM - DD, bijv: 1980-12-31");
