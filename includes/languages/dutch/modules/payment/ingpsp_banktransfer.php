<?php

define('MODULE_PAYMENT_INGPSP_ORDER_DESCRIPTION', "Uw bestelling %s bij %s");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_TEXT_TITLE', "Bankoverschrijving");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_TEXT_DESCRIPTION', "Betaalmethode verstrekt door ING PSP.");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_STATUS_TEXT', "Schakel bankoverschrijving module in");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_STATUS_DESCRIPTION', "Wilt u die bankoverschrivjing module inschakelen?");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_SORT_ORDER_TEXT', "Sorteervolgorde voor Bankoverschrijving");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_SORT_ORDER_DESCRIPTION', "De betaalmethode met de laagste volgorde wordt als eerste weergegeven.");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_ZONE_TEXT', "Zone voor betaalmethode beschikbaarheid");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_ZONE_DESCRIPTION', "Als een zone is geselecteerd, dan is deze betaalmethode alleen voor die zone ingeschakeld.");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_DISPLAY_TITLE_TEXT', "Betaalmethode weergavenaam");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_DISPLAY_TITLE_DESCRIPTION', "Naam van betaalmethode die aan de klant wordt getoond.");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_ERROR_TRANSACTION', "Helaas is er een fout opgetreden tijdens het verwerken van uw betaling. Probeer het alstublieft nogmaals.");
define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_ERROR_ALREADY_INSTALLED', "De Bankoverschrijving module is al geïnstalleerd.");

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_INFORMATION', 'Gebruik de volgende informatie tijdens het uitvoeren van de overschrijving:
<br/> Referentie: <b>{{reference}}</b>
<br/> IBAN:  <b>NL13INGB0005300060</b>
<br/> BIC:  <b>INGBNL2A</b>
<br/> Rekeninghouder:  <b>ING Bank N.V. PSP</b>
<br/> Plaats:  <b>Amsterdam</b>
<br/><br/>');

define('MODULE_PAYMENT_INGPSP_BANKTRANSFER_INFORMATION_EMAIL', 'Gebruik de volgende informatie tijdens het uitvoeren van de overschrijving:
Referentie: {{reference}}
IBAN: NL13INGB0005300060
BIC: INGBNL2A
Rekeninghouder: ING Bank N.V. PSP
Plaats: Amsterdam');
