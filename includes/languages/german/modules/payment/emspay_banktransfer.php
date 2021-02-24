<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Ihre Bestellung %s bei %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "Banküberweisung");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Zahlungsmethode von EMS Online");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Aktivieren Banküberweisung");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Wollen Sie Banküberweisung aktivieren?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sortierreihenfolge für Banküberweisung");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "Die Zahlungsmethode mit der niedrigsten Reihenfolge wird zuerst angezeigt.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Zone für die Verfügbarkeit der Zahlungsmethode");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "Wenn eine Zone ausgewählt ist, ist diese Zahlungsmethode nur für diese Zone aktiviert.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Zahlungsmethode Anzeigename");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Name der Zahlungsmethode, die dem Kunden angezeigt wird.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "Leider ist ein Fehler bei der Verarbeitung Ihrer Bezahlung aufgetreten. Bitte versuchen Sie nochmals.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "Das Banküberweisung-Modul ist bereits installiert.");

define('MODULE_PAYMENT_'.$method_name.'_INFORMATION', 'Bitte verwenden Sie die folgenden Informationen während der Banküberweisung:
<br/> Referenz: <b>{{reference}}</ b>
<br/> IBAN: <b>NL13INGB0005300060 </ b>
<br/> BIC: <b>INGBNL2A</ b>
<br/> Kontoinhaber: <b>EMS Bank N.V. PSP</ b>
<br/> Stadt: <b>Amsterdam</ b>
<br/> <br/>');

define('MODULE_PAYMENT_'.$method_name.'_INFORMATION_EMAIL', 'Bitte verwenden Sie die folgenden Informationen während der Banküberweisung:
Referenz: {{reference}}
IBAN: NL79ABNA0842577610
BIC: INGBNL2A
Kontoinhaber: EMS Bank NV PSP
Stadt: Amsterdam');
