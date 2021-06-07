<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Uw bestelling %s bij %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Betaalmethode verstrekt door EMS Online.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Betaalmethode weergavenaam");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Naam van betaalmethode die aan de klant wordt getoond.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Schakel AfterPay module in");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Wilt u die AfterPay module inschakelen?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sorteervolgorde voor AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "De betaalmethode met de laagste volgorde wordt als eerste weergegeven.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Zone voor betaalmethode beschikbaarheid");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "Als een zone is geselecteerd, dan is deze betaalmethode alleen voor die zone ingeschakeld.");

define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_TEXT', "Test API key");
define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_DESCRIPTION', "Vul hier de API Key in van uw test webshop. Dit is alleen van toepassing voor AfterPay. Gebruikt u AfterPay niet dan kunt u dit leeglaten.");

define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_TEXT', "IP adressen voor het testen van AfterPay:");
define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_DESCRIPTION', "U kunt specifieke IP adressen opgeven waarvoor de AfterPay betaalmethode zichtbaar is, bv als u wilt testen (bijvoorbeeld: 128.0.0.1, 255.255.255.255). Vult u niets in dan is de betaalmethode voor alle IP adressen zichtbaar.");

define('MODULE_PAYMENT_'.$method_name.'_DOB', "Gebruik het volgende formaat voor het invoeren van de geboortedatum: JJJJ - MM - DD, bijv: 1980-12-31");
define('MODULE_PAYMENT_'.$method_name.'_GENDER', "Selecteer alstublieft uw geslacht:");
define('MODULE_PAYMENT_'.$method_name.'_MALE', "Man");
define('MODULE_PAYMENT_'.$method_name.'_FEMALE', "Vrouw");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "Helaas is er een fout opgetreden tijdens het verwerken van uw betaling. Probeer het alstublieft nogmaals.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "De AfterPay module is al geïnstalleerd.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION_IS_CANCELLED', "Het spijt ons u te moeten mededelen dat uw aanvraag om uw bestelling achteraf te betalen op dit moment niet door AfterPay wordt geaccepteerd. Dit kan om diverse (tijdelijke) redenen zijn.Voor vragen over uw afwijzing kunt u contact opnemen met de Klantenservice van AfterPay. Of kijk op de website van AfterPay bij \"Veel gestelde vragen\" via de link http://www.afterpay.nl/page/consument-faq onder het kopje \"Gegevenscontrole\". Wij adviseren u voor een andere betaalmethode te kiezen om alsnog de betaling van uw bestelling af te ronden.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_GENDER', "U hebt geen geslacht geselecteerd. Selecteer het juiste geslacht.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_DOB', "Er is een fout opgetreden met de geboortedatum die u heeft opgegeven. Gebruik het volgende formaat voor het invoeren van de geboortedatum: JJJJ - MM - DD, bijv: 1980-12-31");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_TERMS_AND_CONDITIONS', "AUB de algemene voorwaarden accepteren");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_COUNTRY_IS_NOT_VALID', "Helaas kunt u AfterPay niet gebruiken omdat AfterPay alleen beschikbaar is voor adressen in Nederland en België. Gebruik alstublieft het juiste adres of selecteer een andere betaalmethode.");

define('MODULE_PAYMENT_'.$method_name.'_I_ACCEPT', "Ik accepteer AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_TERMS_AND_CONDITIONS', "Gebruiksvoorwaarden");

define('MODULE_PAYMENT_'.$method_name.'_COUNTRIES_AVAILABLE_TEXT', "Landen beschikbaar voor AfterPay");
define('MODULE_PAYMENT_'.$method_name.'_COUNTRIES_AVAILABLE_DESCRIPTION', "Om AfterPay voor elk ander land te kunnen gebruiken, voegt u de landcode (in ISO 2-norm) toe aan het veld 'Beschikbare landen voor AfterPay';. <br> Voorbeeld: BE, NL, FR <br> Wenn das Feld leer ist, ist AfterPay fur alle Lander verfugbar.");

define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_TEXT', "Toegestane valuta's");
define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_DESCRIPTION', "De betalingsmethode is ALLEEN beschikbaar voor geselecteerde valuta's. U kunt deze lijst beheren en vergelijken met valuta's die door uw winkel worden geaccepteerd. <br> Indien leeg ingesteld, worden de valuta's van de winkel vergeleken met de standaardvalutalijst van de betalingsprovider. <br> Geaccepteerd lijstformaat is <i> CODE1, CODE2, CODE3 </i> voorbeeld <i> USD, EUR, UAH </i>.");
