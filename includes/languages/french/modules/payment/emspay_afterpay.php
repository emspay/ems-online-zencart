<?php

define('MODULE_PAYMENT_EMSPAY_ORDER_DESCRIPTION', "Votre commande %s à %s");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_TEXT_TITLE', "AfterPay");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_TEXT_DESCRIPTION', "Méthode de paiement fournie par EMS Online.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_DISPLAY_TITLE_TEXT', "Nom d'affichage de la méthode de paiement");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_DISPLAY_TITLE_DESCRIPTION', "Nom de la méthode de paiement qui sera affichée au client.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_STATUS_TEXT', "Activer le module AfterPay");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_STATUS_DESCRIPTION', "Voulez-vous activer AfterPay?");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_SORT_ORDER_TEXT', "Ordre de tri pour AfterPay");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_SORT_ORDER_DESCRIPTION', "La méthode de paiement avec l'ordre le plus bas est affiché en premier.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ZONE_TEXT', "Zone pour la disponibilité de la méthode de paiement");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ZONE_DESCRIPTION', "Si une zone est sélectionnée, cette méthode de paiement est activée uniquement pour cette zone.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_TEST_API_KEY_TEXT', "Clé API de Test");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_TEST_API_KEY_DESCRIPTION', "Entrez ici le clé API de Test pour tester la mise en œuvre de AfterPay.Si vous n'offrez pas AfterPay, vous pouvez le laisser vide.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_IP_FILTERING_TEXT', "L’adresse(s) IP pour tester AfterPay");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_IP_FILTERING_DESCRIPTION', "L’adresse(s) IP pour tester AfterPay. Vous pouvez spécifier des adresses IP spécifiques pour lesquelles AfterPay est visible. Si vous remplissez rien, alors, AfterPay est visible à toutes les adresses IP. (par exemple si vous souhaitez tester AfterPay, vous pouvez saisir des adresses IP comme 128.0.0.1, 255.255.255.255.)");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_DOB', "Veuillez utiliser le format suivant pour entrer la date de naissance : AAAA-MM-JJ ; par ex: 1980-12-31");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_GENDER', "Veuillez sélectionner votre sexe:");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_MALE', "Homme");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_FEMALE', "Femme");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_TRANSACTION', "Il y avait malheureusement un problème traitant votre paiement. Veuillez reessayer le paiement s'il vous plaît.");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_ALREADY_INSTALLED', "Le module AfterPay est déjà installé.");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_TRANSACTION_IS_CANCELLED', "Nous sommes désolés de vous informer que votre demande de payer plus tard ne peut pas être acceptée par Afterpay. Cela aurait pu être causé par diverses raisons (temporaires). Si vous avez des questions concernant votre refus, s\'il vous plaît contacter le Service clientèle Afterpay via https://www.afterpay.nl/en/customers/contact ou par téléphone via +31 20 72 30 270. Nous vous conseillons de choisir une autre mode de paiement pour effectuer votre commande.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_GENDER', "Vous n'avez pas sélectionné de sexe. Veuillez sélectionner le sexe correct.");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_DOB', "Il y avait une erreur avec la date de naissance que vous avez utilisée. Veuillez utiliser le format suivant pour entrer la date de naissance : AAAA-MM-JJ par ex.1980-12-31");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_TERMS_AND_CONDITIONS', "SVP Acceptez les termes et conditions");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_ERROR_COUNTRY_IS_NOT_VALID', "Malheureusement, vous ne pouvez pas utiliser AfterPay car Afterpay est suelement disponible pour les adresses aux Pays-Bas et en Belgique.S\'il vous plaît utiliser l\'adresse correcte ou sélectionnez un autre mode de paiement.");

define('MODULE_PAYMENT_EMSPAY_AFTERPAY_I_ACCEPT', "J'accepte AfterPay");
define('MODULE_PAYMENT_EMSPAY_AFTERPAY_TERMS_AND_CONDITIONS', "Termes et conditions");