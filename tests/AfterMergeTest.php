<?php

use Ginger\Gateways\baseGingerGateway;
use PHPUnit\Framework\TestCase;

class AfterMergeTest extends TestCase
{
    function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    function testGetGingerGateway()
    {
        self::assertFileExists((__DIR__).'/../includes/classes/gateways/class.gingerGateway.php', 'The class.gingerGateway not exists, merge unsuccessful');
    }

    function testGetBaseGingerGateway()
    {
        self::assertFileExists((__DIR__).'/../includes/classes/gateways/class.baseGingerGateway.php', 'The class.baseGingerGateway not exists, merge unsuccessful');
    }
    function testGetGingerPaymentDefault()
    {
        self::assertFileExists((__DIR__).'/../includes/classes/gateways/class.gingerPaymentDefault.php', 'The class.gingerPaymentDefault not exists, merge unsuccessful');
    }

    function testGetWebhookPath()
    {
        self::assertTrue(true);
    }
}
