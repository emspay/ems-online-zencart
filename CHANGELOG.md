# Changelog ZenCart

** 1.0.0 **

* Initial Release

** 1.0.3 **

* Changed library from ems-php to ginger-php
* Renamed Sofort to Klarna Pay Now
* Renamed Klarna to Klarna Pay Later
* Add American Express, Tikkie Payment Request, WeChat 

** 1.0.4 **

* Fix Captured and shipped functionality

** 1.1.0 **

* Reworked Bank Transfer Payment Method.
* Reworked Klarna Pay Later Payment Method
* Add redirect to payment_url for KP Later payment

** 1.2.0 ** 

* Added the ability for AfterPay to be available in the selected countries.
* Fixed IP-filtering and Payment Method availability Zone method in AfterPay and KlarnaPayLater.
* Replaced locally stored ginger-php library on composer library installer.

** 1.2.1 **

* Removed WebHook option from all payments.
* Added data filter to createOrder
* Update plugin description.