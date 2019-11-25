<?php

define('MODULE_PAYMENT_EMSPAY_ORDER_DESCRIPTION', "Votre commande %s à %s");

define('MODULE_PAYMENT_EMSPAY_KLARNA_TEXT_TITLE', "Klarna");
define('MODULE_PAYMENT_EMSPAY_KLARNA_TEXT_DESCRIPTION', "Méthode de paiement fournie par EMS Online.");

define('MODULE_PAYMENT_EMSPAY_KLARNA_DISPLAY_TITLE_TEXT', "Nom d'affichage de la méthode de paiement");
define('MODULE_PAYMENT_EMSPAY_KLARNA_DISPLAY_TITLE_DESCRIPTION', "Nom de la méthode de paiement qui sera affichée au client.");

define('MODULE_PAYMENT_EMSPAY_KLARNA_STATUS_TEXT', "Activer le module Klarna");
define('MODULE_PAYMENT_EMSPAY_KLARNA_STATUS_DESCRIPTION', "Voulez-vous activer Klarna?");

define('MODULE_PAYMENT_EMSPAY_KLARNA_SORT_ORDER_TEXT', "Ordre de tri pour Klarna");
define('MODULE_PAYMENT_EMSPAY_KLARNA_SORT_ORDER_DESCRIPTION', "La méthode de paiement avec l'ordre le plus bas est affiché en premier.");

define('MODULE_PAYMENT_EMSPAY_KLARNA_ZONE_TEXT', "Zone pour la disponibilité de la méthode de paiement");
define('MODULE_PAYMENT_EMSPAY_KLARNA_ZONE_DESCRIPTION', "Si une zone est sélectionnée, cette méthode de paiement est activée uniquement pour cette zone.");

define('MODULE_PAYMENT_EMSPAY_KLARNA_TEST_API_KEY_TEXT', "Clé API de Test");
define('MODULE_PAYMENT_EMSPAY_KLARNA_TEST_API_KEY_DESCRIPTION', "Entrez ici le clé API de Test pour tester la mise en œuvre de Klarna.Si vous n'offrez pas Klarna, vous pouvez le laisser vide.");

define('MODULE_PAYMENT_EMSPAY_KLARNA_IP_FILTERING_TEXT', "L’adresse(s) IP pour tester Klarna");
define('MODULE_PAYMENT_EMSPAY_KLARNA_IP_FILTERING_DESCRIPTION', "L’adresse(s) IP pour tester Klarna. Vous pouvez spécifier des adresses IP spécifiques pour lesquelles Klarna est visible. Si vous remplissez rien, alors, Klarna est visible à toutes les adresses IP. (par exemple si vous souhaitez tester Klarna, vous pouvez saisir des adresses IP comme 128.0.0.1, 255.255.255.255.)");

define('MODULE_PAYMENT_EMSPAY_KLARNA_DOB', "Veuillez utiliser le format suivant pour entrer la date de naissance : AAAA-MM-JJ ; par ex: 1980-12-31");
define('MODULE_PAYMENT_EMSPAY_KLARNA_GENDER', "Veuillez sélectionner votre sexe:");
define('MODULE_PAYMENT_EMSPAY_KLARNA_MALE', "Homme");
define('MODULE_PAYMENT_EMSPAY_KLARNA_FEMALE', "Femme");

define('MODULE_PAYMENT_EMSPAY_KLARNA_ERROR_TRANSACTION', "Il y avait malheureusement un problème traitant votre paiement. Veuillez reessayer le paiement s'il vous plaît.");
define('MODULE_PAYMENT_EMSPAY_KLARNA_ERROR_ALREADY_INSTALLED', "Le module Klarna est déjà installé.");
define('MODULE_PAYMENT_EMSPAY_KLARNA_ERROR_TRANSACTION_IS_CANCELLED', "Malheureusement, nous ne pouvons pas actuellement accepter votre achat avec Klarna. Veuillez choisir une autre option de paiement pour compléter votre commande. Nous nous excusons pour le dérangement.");

define('MODULE_PAYMENT_EMSPAY_KLARNA_ERROR_GENDER', "Vous n'avez pas sélectionné de sexe. Veuillez sélectionner le sexe correct.");
define('MODULE_PAYMENT_EMSPAY_KLARNA_ERROR_DOB', "Il y avait une erreur avec la date de naissance que vous avez utilisée. Veuillez utiliser le format suivant pour entrer la date de naissance : AAAA-MM-JJ par ex.1980-12-31");
