<?php

define('MODULE_PAYMENT_EMSPAY_ORDER_DESCRIPTION', "Ihre Bestellung %s bei %s");

define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_TEXT_TITLE', "Banküberweisung");
define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_TEXT_DESCRIPTION', "Zahlungsmethode von EMS PAY");

define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_STATUS_TEXT', "Aktivieren Banküberweisung");
define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_STATUS_DESCRIPTION', "Wollen Sie Banküberweisung aktivieren?");

define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_SORT_ORDER_TEXT', "Sortierreihenfolge für Banküberweisung");
define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_SORT_ORDER_DESCRIPTION', "Die Zahlungsmethode mit der niedrigsten Reihenfolge wird zuerst angezeigt.");

define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_ZONE_TEXT', "Zone für die Verfügbarkeit der Zahlungsmethode");
define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_ZONE_DESCRIPTION', "Wenn eine Zone ausgewählt ist, ist diese Zahlungsmethode nur für diese Zone aktiviert.");

define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_DISPLAY_TITLE_TEXT', "Zahlungsmethode Anzeigename");
define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_DISPLAY_TITLE_DESCRIPTION', "Name der Zahlungsmethode, die dem Kunden angezeigt wird.");

define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_ERROR_TRANSACTION', "Leider ist ein Fehler bei der Verarbeitung Ihrer Bezahlung aufgetreten. Bitte versuchen Sie nochmals.");
define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_ERROR_ALREADY_INSTALLED', "Das Banküberweisung-Modul ist bereits installiert.");

define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_INFORMATION', 'Bitte verwenden Sie die folgenden Informationen während der Banküberweisung:
<br/> Referenz: <b>{{reference}}</ b>
<br/> IBAN: <b>NL13INGB0005300060 </ b>
<br/> BIC: <b>INGBNL2A</ b>
<br/> Kontoinhaber: <b>ING Bank N.V. PSP</ b>
<br/> Stadt: <b>Amsterdam</ b>
<br/> <br/>');

define('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_INFORMATION_EMAIL', 'Bitte verwenden Sie die folgenden Informationen während der Banküberweisung:
Referenz: {{reference}}
IBAN: NL13INGB0005300060
BIC: INGBNL2A
Kontoinhaber: ING Bank NV PSP
Stadt: Amsterdam');
