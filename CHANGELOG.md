# Changelog ZenCart

## 1.0.0 ##

* Initial Release

### 1.0.3 ###

* Changed library from ems-php to ginger-php
* Renamed Sofort to Klarna Pay Now
* Renamed Klarna to Klarna Pay Later
* Add American Express, Tikkie Payment Request, WeChat 

### 1.0.4 ###

* Fix Captured and shipped functionality

## 1.1.0 ##

* Reworked Bank Transfer Payment Method.
* Reworked Klarna Pay Later Payment Method
* Add redirect to payment_url for KP Later payment

## 1.2.0 ##

* Added the ability for AfterPay to be available in the selected countries.
* Fixed IP-filtering and Payment Method availability Zone method in AfterPay and KlarnaPayLater.
* Replaced locally stored ginger-php library on composer library installer.

### 1.2.1 ###

* Removed WebHook option from all payments.
* Update plugin description.

## 1.3.0 ## 

* Updated EMS to ZenCart status mapping.
* Completed utilize duplicate code.
* Custom prefixes were added to all function/files.
* Input_filter was added to all variables from the HTTP request.
* Plugin structure changes to supporting via GPE solution.
* Plugin code has been refactored to best supporting via GPE solution.

## 1.3.1 ##

* PHPUnit tests was added to cover GPE solution workability.