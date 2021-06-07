<?php

use PHPUnit\Framework\TestCase;

class CreateOrderTest extends TestCase
{
    /**
     * @var MockedOrderBuilder
     */
    private $orderBuilder;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        require_once "MockedOrderBuilder.php";
        $this->orderBuilder = new MockedOrderBuilder();
        parent::__construct($name, $data, $dataName);
    }

    function testGetAmount()
    {
        $expected_amount = 1000;
        $real_amount = $this->orderBuilder->getAmount();
        $this->assertSame($expected_amount, $real_amount);
    }

    function testGetCurrency()
    {
        $expected_currency = "EUR";
        $real_currency = $this->orderBuilder->getCurrency();
        $this->assertSame($expected_currency, $real_currency);
    }

    function testGetDescription()
    {
        $expected_description = "Your order 1 at GingerShop";
        $real_description = $this->orderBuilder->getDescription();
        $this->assertSame($expected_description, $real_description);
    }

    function testGetMerchantOrderId()
    {
        $expected_merchant_order_id = 1;
        $real_merchant_order_id = $this->orderBuilder->getOrderId();
        $this->assertSame($expected_merchant_order_id, $real_merchant_order_id);
    }

    function testGetReturnUrl()
    {
        $expected_return_url = 'localhost';
        $real_return_url = $this->orderBuilder->getReturnUrl();
        $this->assertSame($expected_return_url, $real_return_url);
    }

    function testGetExtra()
    {
        $expected_extra = array(
            'plugin' => "ZenCart v6.6.6"
        );
        $real_extra = $this->orderBuilder->getPluginVersion();
        $this->assertSame($expected_extra, $real_extra);
    }

    function testGetWebhookUrl()
    {
        $expected_webhook_url = 'https/ginger_webhook.php';
        $real_webhook_url = $this->orderBuilder->getWebhookUrl();
        $this->assertSame($expected_webhook_url, $real_webhook_url);
    }

    function testGetCustomer()
    {
        $expected_customer = array(
            'address_type' => 'billing',
            'merchant_customer_id' => '1',
            'email_address' => 'ginger@plugins',
            'first_name' => 'ginger',
            'last_name' => 'plugins',
            'address' => 'Donauweg 10  1043AJ Amsterdam',
            'postal_code' => '1043AJ',
            'country' => 'NL',
            'phone_numbers' => array(
                '0123456789'
            ),
            'user_agent' => 'user-agent',
            'ip_address' => '127.0.0.1',
            'locale' => 'EN'
        );
        $real_customer = $this->orderBuilder->getCustomer();
        $this->assertSame($expected_customer, $real_customer);
    }

    function testGetOrderLines()
    {
        $expected_order_lines = array(
            array
            (
                'name' => 'payment',
                'currency' => 'EUR',
                'type' => 'physical',
                'amount' => 750,
                'vat_percentage' => 0,
                'quantity' => 1,
                'merchant_order_line_id' => '1',
                'url' => 'www/ginger'
            ),
            array(
                'quantity' => 1,
                'amount' => 250,
                'name' => 'DHL',
                'type' => 'shipping_fee',
                'currency' => 'EUR',
                'vat_percentage' => 0,
                'merchant_order_line_id' => '2'
            )
        );
        $real_order_lines = $this->orderBuilder->getOrderLines();
        return $this->assertSame($expected_order_lines, $real_order_lines);
    }

    function testGetOrder()
    {
        $expected_order = array(
            'amount' => 1000,
            'currency' => 'EUR',
            'description' => 'Your order 1 at GingerShop',
            'merchant_order_id' => '1',
            'return_url' => 'localhost',
            'customer' => array(
                'address_type' => 'billing',
                'merchant_customer_id' => '1',
                'email_address' => 'ginger@plugins',
                'first_name' => 'ginger',
                'last_name' => 'plugins',
                'address' => 'Donauweg 10  1043AJ Amsterdam',
                'postal_code' => '1043AJ',
                'country' => 'NL',
                'phone_numbers' => array(
                    0 => '0123456789'
                ),
                'user_agent' => 'user-agent',
                'ip_address' => '127.0.0.1',
                'locale' => 'EN',
            ),
            'extra' => array(
                'plugin' => 'ZenCart v6.6.6'
            ),
            'webhook_url' => 'https/ginger_webhook.php',
            'transactions' => array(
                array(
                    'payment_method' => 'apple-pay'
                )
            )
        );
        $real_order = $this->orderBuilder->getOrder();
        $this->assertSame($expected_order, $real_order);
    }
}
