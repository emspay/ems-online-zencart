<?php

define('MODULE_PAYMENT_EMSPAY_ORDER_DESCRIPTION', "Ihre Bestellung %s bei %s");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_TEXT_TITLE', "AfterPay");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_TEXT_DESCRIPTION', "Zahlungsmethode von EMS Online");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_DISPLAY_TITLE_TEXT', "Zahlungsmethode Anzeigename");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_DISPLAY_TITLE_DESCRIPTION', "Name der Zahlungsmethode, die dem Kunden angezeigt wird.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_STATUS_TEXT', "Aktivieren AfterPay");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_STATUS_DESCRIPTION', "Wollen Sie die AfterPay aktivieren?");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_SORT_ORDER_TEXT', "Sortierreihenfolge für AfterPay");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_SORT_ORDER_DESCRIPTION', "Die Zahlungsmethode mit der niedrigsten Reihenfolge wird zuerst angezeigt.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ZONE_TEXT', "Zone für die Verfügbarkeit der Zahlungsmethode");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ZONE_DESCRIPTION', "Wenn eine Zone ausgewählt ist, ist diese Zahlungsmethode nur für diese Zone aktiviert.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_TEST_API_KEY_TEXT', "Test API Schlüssel");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_TEST_API_KEY_DESCRIPTION', "Bitte geben Sie die API-Schlüssel von der Test Web-Shop für Prüfung AfterPay ein. Dies gilt nur wenn Sie AfterPay offerieren.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_IP_FILTERING_TEXT', "IP-Adresse(n) für Prüfung AfterPay");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_IP_FILTERING_DESCRIPTION', "Sie können spezifische IP-adresse(n) für AfterPay eingeben (zum Beispiel: IP addresse 128.0.0.1, 255.255.255.255). Wenn Sie nichts eingeben ist AfterPay wahrnehmbar in jeder IP-adresse.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_DOB', "Bitte geben Sie ihr Geburtsdatum im folgenden Format an: JJJJ-MM-TT, Z.B. 1980-12-31");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_GENDER', "Bitte wählen Sie Ihr Geschlecht:");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_MALE', "Mann");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_FEMALE', "Frau");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_TRANSACTION', "Leider ist ein Fehler bei der Verarbeitung Ihrer Bezahlung aufgetreten. Bitte versuchen Sie nochmals.");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_ALREADY_INSTALLED', "Das AfterPay-Modul ist bereits installiert.");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_TRANSACTION_IS_CANCELLED', "We are sorry to inform you that your request to pay afterwards cannot be accepted by Afterpay. This could have been caused by various (temporary) reasons. If you have any questions pertaining to your rejection, please contact the Afterpay Customer Service via link https://www.afterpay.nl/en/customers/contact or by phone via +31 20 72 30 270. We advise you to select another payment method to complete the payment of your order.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_GENDER', "Sie haben kein Geschlecht ausgewählt. Bitte wählen Sie das richtige Geschlecht.");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_DOB', "Leider ist ein Fehler aufgetreten mit dem Geburtsdatum. Bitte geben Sie ihr Geburtsdatum im folgenden Format an: JJJJ-MM-TT, Z.B. 1980-12-31");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_TERMS_AND_CONDITIONS', "Bitte akzeptieren Sie die Nutzungsbedingungen");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_COUNTRY_IS_NOT_VALID', "Leider können Sie AfterPay nicht verwenden, da Afterpay nur für Adressen in den Niederlanden und Belgien verfügbar ist. Bitte verwenden Sie die richtige Adresse oder eine andere Zahlungsmethode wählen.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_I_ACCEPT', "Ich akzeptiere AfterPay");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_TERMS_AND_CONDITIONS', "Nutzungsbedingungen");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_COUNTRIES_AVAILABLE_TEXT', "Fur AfterPay verfugbare Lander");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_COUNTRIES_AVAILABLE_DESCRIPTION', "Damit AfterPay fur jedes andere Land verwendet werden kann, fugen Sie einfach seinen Landercode (in ISO 2-Norm) in das Feld 'Fur AfterPay verfugbare Lander' ein. Beispiel: BE, NL, FR");