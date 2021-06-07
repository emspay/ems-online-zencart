<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Ihre Bestellung %s bei %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "Apple Pay");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Die Zahlungsmethode wird bereitgestellt von EMS Online.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Zahlungsmethode Anzeigename");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Name der Zahlungsmethode, die dem Kunden angezeigt wird.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Aktivieren Apple Pay");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Wollen Sie Apple Pay aktivieren?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Sortierreihenfolge für Apple Pay");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "Die Zahlungsmethode mit der niedrigsten Reihenfolge wird zuerst angezeigt.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Zone für die Verfügbarkeit der Zahlungsmethode");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "Wenn eine Zone ausgewählt ist, ist diese Zahlungsmethode nur für diese Zone aktiviert.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "Leider ist ein Fehler bei der Verarbeitung Ihrer Bezahlung aufgetreten. Bitte versuchen Sie nochmals.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "Das Kreditkartenmodul is bereits installiert.");

define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_TEXT', "Zulässige Währungen");
define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_DESCRIPTION', "Die Zahlungsmethode ist NUR für ausgewählte Währungen verfügbar. Sie können diese Liste verwalten und mit Währungen vergleichen, die von Ihrem Shop akzeptiert werden. <br> Wenn leer, werden die Shop-Währungen mit der Liste der Standardwährungen der Zahlungsanbieter verglichen. <br> Akzeptiertes Listenformat ist <i> CODE1, CODE2, CODE3 </i> Beispiel <i> USD, EUR, UAH </i>.");
