<?php

use PHPUnit\Framework\TestCase;

// Mocked stub for testing.
class base
{
    public function __construct()
    {
        return true;
    }
}

define('MODULE_PAYMENT_APPLEPAY_ORDER_DESCRIPTION', "Your order %s at %s");
define('TITLE', "GingerShop");
define('HTTPS_SERVER', 'https');
define('HTTP_SERVER', 'http');
define('ENABLE_SSL', true);

class MockedOrderBuilder extends TestCase
{
    /**
     * @var gingerGateway
     */
    private $gingerGateway;
    /**
     * @var object
     */
    private $order;

    public function __construct()
    {
        require_once __DIR__ . "/../includes/classes/gateways/autoload.php";

        $_SESSION['order_summary']['order_number'] = 1;
        $_SESSION['customer_id'] = 1;
        $_SESSION['languages_code'] = 'EN';
        $_SESSION['customers_ip_address'] = '127.0.0.1';
        $_SERVER['HTTP_USER_AGENT'] = 'user-agent';

        $this->order = (object)array(
            'info' => [
                'total' => 10.00,
                'currency' => 'EUR',
                'shipping_cost' => 2.50,
                'shipping_tax' => 0,
                'shipping_method' => 'DHL'
            ],
            'customer' => [
                'email_address' => 'ginger@plugins',
                'firstname' => 'ginger',
                'lastname' => 'plugins',
                'telephone' => '0123456789'
            ],
            'billing' => [
                'street_address' => 'Donauweg 10',
                'suburb' => null,
                'postcode' => '1043AJ',
                'city' => 'Amsterdam',
                'country' => [
                    'iso_code_2' => 'NL'
                ]
            ],
            'products' => array([
                'name' => 'payment',
                'qty' => 1,
                'id' => 1,
                'tax' => 0,
                'final_price' => 7.50,
                'amount' => 750,
                'url' => 'www/ginger'
            ])
        );
        $this->gingerGateway = new gingerGateway();
        $this->gingerGateway->code = 'applepay';
        $this->gingerGateway->moduleVersion = '6.6.6';
    }

    public function getAmount()
    {
        return $this->gingerGateway->gerOrderTotalInCents($this->order);
    }

    public function getCurrency()
    {
        return $this->gingerGateway->getCurrency($this->order);
    }

    public function getDescription()
    {
        return $this->gingerGateway->getOrderDescription();
    }

    public function getOrderId()
    {
        return $this->gingerGateway->getOrderId();
    }

    public function getReturnUrl()
    {
        return $this->gingerGateway->getReturnUrl();
    }

    public function getPluginVersion()
    {
        return $this->gingerGateway->getPluginVersion();
    }

    public function getWebhookUrl()
    {
        return $this->gingerGateway->getWebhookUrl();
    }

    public function getCustomer()
    {
        return $this->gingerGateway->getCustomerInfo($this->order);
    }

    public function getOrderLines()
    {
        return $this->gingerGateway->getOrderLines($this->order);
    }

    public function getOrder()
    {
        return $this->gingerGateway->getInfoForGingerOrder($this->order);
    }
}