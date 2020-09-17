# EMS Online plugin for ZenCart

## About
This is the offical EMS Online plugin.

By integrating your webshop with EMS Online you can accept payments from your customers in an easy and trusted manner with all relevant payment methods supported. 

## Version number
Version 1.1.1

## Pre-requisites to install the plug-ins 
* PHP v5.4 and above
* MySQL v5.4 and above

## Installation
 1. Upload all of the folders in the ZIP file into your ZenCart public path (no files are transferred). You can use an sFTP or SCP program, for example, to upload the files. There are various sFTP clients that you can download free of charge from the internet, such as WinSCP or Filezilla.

 2. Go to your ZenCart admin environment 'Localization' > ' Orders Status' > click 'Insert' button and add new order statuses as follows:
 
    - Order Status field
    - Completed
    - Cancelled
    - Error
    - Shipped

 3. Install the EMS Online module Go to your ZenCart admin environment 'Modules' > 'Payment' , select 'EMS Online' module and click 'Install'.

    Configure the EMS Online module by using the following settings:

    - Enable EMS Online module : 'True'

    - EMS Online API Key : enter your EMS Online API key

    - Generate Webhook URL: 'True'

    - Use cUrl CA bundle: 'True'
    Enable this option to fix a cURL SSL Certificate issue that appears in some web-hosting environments where you do not have access to the PHP.ini file and therefore are not able to update server certificates.

    - Configure the order statuses and click 'Update'

        - Status for a completed order: 'Completed'

        - Status for a pending order: 'Pending'

        - Status for an error order: 'Error'

        - Status for an order being processed: 'Processing'

        - Status for a cancelled order: 'Cancelled'

        - Status for a shipped order: 'Shipped'

4. After configuring  EMS Online module, install the payment method you want to add to your payment page and click 'Install'.
For every payment method you have to enable he payment module by setting the value to 'True' and click 'Update'.

5. Perform step 4 for every payment method you want to add to your payment page.

6. Klarna specific configuration
For the payment method Klarna there are several specific settings:

    Test API key
Copy the API Key of your test webshop in the Test API key field.
When your Klarna application was approved an extra test webshop was created for you to use in your test with Klarna. The name of this webshop starts with ‘TEST Klarna’.

    IP Filtering
You can choose to offer Klarna only to a limited set of whitelisted IP addresses. You can use this for instance when you are in the testing phase and want to make sure that Klarna is not available yet for your customers.
To do this enter the IP addresses that you want to whitelist, separate the addresses by a comma (“,”). The payment method Klarna will only be presented to customers who use a whitelisted IP address.
If you want to offer Klarna to all your customers, you can leave the field empty.

7. AfterPay specific configuration
For the payment method Afterpay, refer to the specific settings for Klarna.

    To allow AfterPay to be used for any other country just add its country code (in ISO 2 standard) to the "Countries available for AfterPay" field. Example: BE, NL, FR

