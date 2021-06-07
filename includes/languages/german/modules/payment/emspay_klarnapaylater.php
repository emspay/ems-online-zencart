<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Ihre Bestellung %s bei %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Zahlungsmethode von EMS Online");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Zahlungsmethode Anzeigename");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Name der Zahlungsmethode, die dem Kunden angezeigt wird.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Aktivieren Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Wollen Sie die Klarna Pay Later aktivieren?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sortierreihenfolge für Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "Die Zahlungsmethode mit der niedrigsten Reihenfolge wird zuerst angezeigt.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Zone für die Verfügbarkeit der Zahlungsmethode");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "Wenn eine Zone ausgewählt ist, ist diese Zahlungsmethode nur für diese Zone aktiviert.");

define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_TEXT', "Test API Schlüssel");
define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_DESCRIPTION', "Bitte geben Sie die API-Schlüssel von der Test Web-Shop für Prüfung Klarna Pay Later ein. Dies gilt nur wenn Sie Klarna Pay Later offerieren.");

define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_TEXT', "IP-Adresse(n) für Prüfung Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_DESCRIPTION', "Sie können spezifische IP-adresse(n) für Klarna Pay Later eingeben (zum Beispiel: IP addresse 128.0.0.1, 255.255.255.255). Wenn Sie nichts eingeben ist Klarna Pay Later wahrnehmbar in jeder IP-adresse.");

define('MODULE_PAYMENT_'.$method_name.'_DOB', "Bitte geben Sie ihr Geburtsdatum im folgenden Format an: JJJJ-MM-TT, Z.B. 1980-12-31");
define('MODULE_PAYMENT_'.$method_name.'_GENDER', "Bitte wählen Sie Ihr Geschlecht:");
define('MODULE_PAYMENT_'.$method_name.'_MALE', "Mann");
define('MODULE_PAYMENT_'.$method_name.'_FEMALE', "Frau");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "Leider ist ein Fehler bei der Verarbeitung Ihrer Bezahlung aufgetreten. Bitte versuchen Sie nochmals.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "Das Klarna Pay Later-Modul ist bereits installiert.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION_IS_CANCELLED', "Leider können wir Ihren Kauf mit Klarna Pay Later derzeit nicht akzeptieren. Bitte wählen Sie eine andere Zahlungsmöglichkeit, um Ihre Bestellung abzuschließen. Wir entschuldigen uns für die Unannehmlichkeiten.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_GENDER', "Sie haben kein Geschlecht ausgewählt. Bitte wählen Sie das richtige Geschlecht.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_DOB', "Leider ist ein Fehler aufgetreten mit dem Geburtsdatum. Bitte geben Sie ihr Geburtsdatum im folgenden Format an: JJJJ-MM-TT, Z.B. 1980-12-31");

define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_TEXT', "Zulässige Währungen");
define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_DESCRIPTION', "Die Zahlungsmethode ist NUR für ausgewählte Währungen verfügbar. Sie können diese Liste verwalten und mit Währungen vergleichen, die von Ihrem Shop akzeptiert werden. <br> Wenn leer, werden die Shop-Währungen mit der Liste der Standardwährungen der Zahlungsanbieter verglichen. <br> Akzeptiertes Listenformat ist <i> CODE1, CODE2, CODE3 </i> Beispiel <i> USD, EUR, UAH </i>.");
