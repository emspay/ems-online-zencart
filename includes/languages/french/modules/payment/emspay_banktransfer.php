<?php
$method_name = strtoupper(explode('.php',basename(__FILE__))[0]);

define('MODULE_PAYMENT_'.$method_name.'_ORDER_DESCRIPTION', "Votre commande %s à %s");

define('MODULE_PAYMENT_'.$method_name.'_TEXT_TITLE', "Virement Bancaire");
define('MODULE_PAYMENT_'.$method_name.'_TEXT_DESCRIPTION', "Méthode de paiement fournie par EMS Online.");

define('MODULE_PAYMENT_'.$method_name.'_STATUS_TEXT', "Activer Virement Bancaire");
define('MODULE_PAYMENT_'.$method_name.'_STATUS_DESCRIPTION', "Voulez-vous activer Virement Bancaire?");

define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_TEXT', "Ordre de tri pour Virement Bancaire");
define('MODULE_PAYMENT_'.$method_name.'_SORT_ORDER_DESCRIPTION', "La methode de paiement avec l'ordre le plus bas est affiché en premier.");

define('MODULE_PAYMENT_'.$method_name.'_ZONE_TEXT', "Zone pour la disponibilité de la méthode de paiement");
define('MODULE_PAYMENT_'.$method_name.'_ZONE_DESCRIPTION', "Si une zone est sélectionnée, cette méthode de paiement est activée uniquement pour cette zone.");

define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_TEXT', "Nom d'affichage de la méthode de paiement");
define('MODULE_PAYMENT_'.$method_name.'_DISPLAY_TITLE_DESCRIPTION', "Nom de la méthode de paiement qui sera affichée au client.");

define('MODULE_PAYMENT_'.$method_name.'_ERROR_TRANSACTION', "Il y avait malheureusement un problème traitant votre paiement. Veuillez réessayer le paiement s'il vous plaît.");
define('MODULE_PAYMENT_'.$method_name.'_ERROR_ALREADY_INSTALLED', "Le module virement bancaire est déjà installé.");

define('MODULE_PAYMENT_'.$method_name.'_INFORMATION', 'Veuillez utiliser les informations suivantes lors du virement bancaire:
<br/> Référence: <b>{{reference}}</ b>
<br/> IBAN: <b>NL13INGB0005300060</ b>
<br/> BIC: <b>INGBNL2A</ b>
<br/> Titulaire du compte: <b>EMS Bank N.V. PSP</ b>
<br/> Ville: <b>Amsterdam</ b>
<br/> <br/>');

define('MODULE_PAYMENT_'.$method_name.'_INFORMATION_EMAIL', 'Veuillez utiliser les informations suivantes lors du virement bancaire:
Référence: {{reference}}
IBAN: NL79ABNA0842577610
BIC: INGBNL2A
Titulaire du compte: EMS Bank N.V. PSP
Ville: Amsterdam');

define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_TEXT', "Devises autorisées");
define('MODULE_PAYMENT_'.$method_name.'_MULTICURRENCIES_DESCRIPTION', "Le mode de paiement sera disponible UNIQUEMENT pour les devises sélectionnées. Vous pouvez gérer cette liste et la comparer avec les devises acceptées par votre boutique. <br> Si ce paramètre est vide, les devises de la boutique seront comparées à la liste des devises du fournisseur de paiement standard. <br> Le format de liste accepté est <i> CODE1, CODE2, CODE3 </i> exemple <i> USD, EUR, UAH </i>.");
