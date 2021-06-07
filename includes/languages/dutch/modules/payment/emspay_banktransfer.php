<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Uw bestelling %s bij %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "Bankoverschrijving");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Betaalmethode verstrekt door EMS Online.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Schakel bankoverschrijving module in");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Wilt u die bankoverschrivjing module inschakelen?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sorteervolgorde voor Bankoverschrijving");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "De betaalmethode met de laagste volgorde wordt als eerste weergegeven.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Zone voor betaalmethode beschikbaarheid");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "Als een zone is geselecteerd, dan is deze betaalmethode alleen voor die zone ingeschakeld.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Betaalmethode weergavenaam");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Naam van betaalmethode die aan de klant wordt getoond.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "Helaas is er een fout opgetreden tijdens het verwerken van uw betaling. Probeer het alstublieft nogmaals.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "De Bankoverschrijving module is al ge�nstalleerd.");

define('MODULE_PAYMENT_'.$method_name.'_INFORMATION', 'Gebruik de volgende informatie tijdens het uitvoeren van de overschrijving:
<br/> Referentie: <b>{{reference}}</b>
<br/> IBAN:  <b>NL13INGB0005300060</b>
<br/> BIC:  <b>INGBNL2A</b>
<br/> Rekeninghouder:  <b>EMS Bank N.V. PSP</b>
<br/> Plaats:  <b>Amsterdam</b>
<br/><br/>');

define('MODULE_PAYMENT_'.$method_name.'_INFORMATION_EMAIL', 'Gebruik de volgende informatie tijdens het uitvoeren van de overschrijving:
Referentie: {{reference}}
IBAN: NL79ABNA0842577610
BIC: INGBNL2A
Rekeninghouder: EMS Bank N.V. PSP
Plaats: Amsterdam');

define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_TEXT', "Toegestane valuta's");
define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_DESCRIPTION', "De betalingsmethode is ALLEEN beschikbaar voor geselecteerde valuta's. U kunt deze lijst beheren en vergelijken met valuta's die door uw winkel worden geaccepteerd. <br> Indien leeg ingesteld, worden de valuta's van de winkel vergeleken met de standaardvalutalijst van de betalingsprovider. <br> Geaccepteerd lijstformaat is <i> CODE1, CODE2, CODE3 </i> voorbeeld <i> USD, EUR, UAH </i>.");
