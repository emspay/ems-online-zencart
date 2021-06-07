<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Votre commande %s à %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Méthode de paiement fournie par EMS Online.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Nom d'affichage de la méthode de paiement");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Nom de la méthode de paiement qui sera affichée au client.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Activer le module Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Voulez-vous activer Klarna Pay Later?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Ordre de tri pour Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "La méthode de paiement avec l'ordre le plus bas est affiché en premier.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Zone pour la disponibilité de la méthode de paiement");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "Si une zone est sélectionnée, cette méthode de paiement est activée uniquement pour cette zone.");

define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_TEXT', "Clé API de Test");
define('MODULE_PAYMENT_'.$method_name.'_TEST_API_KEY_DESCRIPTION', "Entrez ici le clé API de Test pour tester la mise en œuvre de Klarna Pay Later.Si vous n'offrez pas Klarna Pay Later, vous pouvez le laisser vide.");

define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_TEXT', "L’adresse(s) IP pour tester Klarna Pay Later");
define('MODULE_PAYMENT_'.$method_name.'_IP_FILTERING_DESCRIPTION', "L’adresse(s) IP pour tester Klarna Pay Later. Vous pouvez spécifier des adresses IP spécifiques pour lesquelles Klarna Pay Later est visible. Si vous remplissez rien, alors, Klarna Pay Later est visible à toutes les adresses IP. (par exemple si vous souhaitez tester Klarna Pay Later, vous pouvez saisir des adresses IP comme 128.0.0.1, 255.255.255.255.)");

define('MODULE_PAYMENT_'.$method_name.'_DOB', "Veuillez utiliser le format suivant pour entrer la date de naissance : AAAA-MM-JJ ; par ex: 1980-12-31");
define('MODULE_PAYMENT_'.$method_name.'_GENDER', "Veuillez sélectionner votre sexe:");
define('MODULE_PAYMENT_'.$method_name.'_MALE', "Homme");
define('MODULE_PAYMENT_'.$method_name.'_FEMALE', "Femme");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "Il y avait malheureusement un problème traitant votre paiement. Veuillez reessayer le paiement s'il vous plaît.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "Le module Klarna Pay Later Pay Later est déjà installé.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION_IS_CANCELLED', "Malheureusement, nous ne pouvons pas actuellement accepter votre achat avec Klarna Pay Later. Veuillez choisir une autre option de paiement pour compléter votre commande. Nous nous excusons pour le dérangement.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_GENDER', "Vous n'avez pas sélectionné de sexe. Veuillez sélectionner le sexe correct.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_DOB', "Il y avait une erreur avec la date de naissance que vous avez utilisée. Veuillez utiliser le format suivant pour entrer la date de naissance : AAAA-MM-JJ par ex.1980-12-31");

define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_TEXT', "Devises autorisées");
define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_DESCRIPTION', "Le mode de paiement sera disponible UNIQUEMENT pour les devises sélectionnées. Vous pouvez gérer cette liste et la comparer avec les devises acceptées par votre boutique. <br> Si ce paramètre est vide, les devises de la boutique seront comparées à la liste des devises du fournisseur de paiement standard. <br> Le format de liste accepté est <i> CODE1, CODE2, CODE3 </i> exemple <i> USD, EUR, UAH </i>.");
