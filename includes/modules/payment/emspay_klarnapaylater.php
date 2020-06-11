<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/class.emspayGateway.php');

/**
 * Class emspay_klarnapaylater
 */
class emspay_klarnapaylater extends emspayGateway
{
    public $code = 'emspay_klarnapaylater';

    /**
     * emspay_klarnapaylater constructor.
     */
    function __construct()
    {
        $this->title = MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_TEXT_TITLE;
        $this->description = MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_TEXT_DESCRIPTION;
        $this->sort_order = MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_STATUS == 'True')?true:false);

        parent::__construct();
    }

    /**
     * Install function.
     *
     * @return null|string
     */
    public function install()
    {
        global $messageStack;

        if (defined('MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_STATUS')) {
            $messageStack->add_session(MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_ERROR_ALREADY_INSTALLED, 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module='.$this->code, 'SSL'));
            return 'failed';
        }

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_STATUS_TEXT,
            'configuration_description' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_STATUS_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_STATUS',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => 1,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_DISPLAY_TITLE_TEXT,
            'configuration_description' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_DISPLAY_TITLE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_DISPLAY_TITLE',
            'configuration_value' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_TEXT_TITLE,
            'configuration_group_id' => 6,
            'sort_order' => 2
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_TEST_API_KEY_TEXT,
            'configuration_description' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_TEST_API_KEY_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_TEST_API_KEY',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => 3
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_IP_FILTERING_TEXT,
            'configuration_description' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_IP_FILTERING_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_IP_FILTERING',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => 4
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_SORT_ORDER_TEXT,
            'configuration_description' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_SORT_ORDER_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_SORT_ORDER',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 5
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_ZONE_TEXT,
            'configuration_description' => MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_ZONE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_ZONE',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 6,
            'use_function' => 'zen_get_zone_class_title',
            'set_function' => 'zen_cfg_pull_down_zone_classes(',
        ]);

        return null;
    }

    /**
     * Returns array of configurable field.
     *
     * @return array
     */
    public function keys()
    {
        return array(
            'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_DISPLAY_TITLE',
            'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_TEST_API_KEY',
            'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_IP_FILTERING',
            'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_STATUS',
            'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_SORT_ORDER',
            'MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_ZONE'
        );
    }

    /**
     * @return array
     */
    public function selection()
    {
        return [
            'id' => $this->code,
            'module' => "<img src='".DIR_WS_IMAGES."emspay/".$this->code.".png' /> ".$this->title
        ];
    }

    /**
     * @return string
     */
    public function process_button()
    {
        return zen_draw_hidden_field(zen_session_name(), zen_session_id());
    }

    /**
     * Redirect after return_url action
     * @return null|void
     */
    public function before_process()
    {
        if (array_key_exists('order_id', $_GET)) {
            $this->statusRedirect(filter_input(INPUT_GET, 'order_id', FILTER_SANITIZE_STRING));
        }
    }

    /**
     * Order processing method.
     */
    public function after_process()
    {
        global $order, $messageStack;
        try {
            $emsOrder = $this->emspay->createOrder([
                'amount' => $this->gerOrderTotalInCents($order),                // amount in cents
                'currency' => $this->getCurrency($order),                       // currency
                'description' => $this->getOrderDescription(),                  // order description
                'merchant_order_id' => (string) $this->getOrderId(),            // merchantOrderId
                'return_url' => $this->getReturnUrl(),                          // returnUrl
                'customer' => $this->getCustomerInfo($order),                   // customer
                'extra' => $this->getPluginVersion(),                           // extra information
                'webhook_url' => $this->getWebhookUrl(),                        // webhook_url
                'order_linesui' => $this->getOrderLines($order),                // orderlines
                'transactions' => [
                    [
                        'payment_method' => 'klarna-pay-later'
                    ]
                ]
            ]);

            static::updateOrderStatus($this->getOrderId(), static::getZenStatusId($emsOrder));
            static::addOrderHistory($this->getOrderId(), static::getZenStatusId($emsOrder), $emsOrder['id']);

            if ($emsOrder['status'] == 'error') {
                $messageStack->add_session(
                    'checkout_payment',
                    $emsOrder['transactions'][0]['reason'],
                    'error'
                );
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            } elseif ($emsOrder['status'] == 'canceled') {
                $messageStack->add_session(
                    'checkout_payment',
                    MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_ERROR_TRANSACTION_IS_CANCELLED,
                    'error'
                );
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
           zen_redirect(current($emsOrder['transactions'])['payment_url']);
        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', $exception->getMessage(), 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }

    /**
     * Generate order lines from the order
     *
     * @param order $order
     * @return array
     */
    public function getOrderLines($order)
    {
        $orderLines = [];
        foreach ($order->products as $product) {
            $orderLines[] = [
                'name' => (string) $product['name'],
                'currency' => 'EUR',
                'type' => 'physical',
                'amount' => $this->getAmountInCents(
                    $product['final_price'] + zen_calculate_tax($product['final_price'], $product['tax'])
                ),
                'vat_percentage' => $this->getAmountInCents($product['tax']),
                'quantity' => (int) $product['qty'],
                'merchant_order_line_id' => $product['id'],
                'url' => zen_href_link(FILENAME_PRODUCT_INFO, 'products_id='.$product['id'])
            ];
        }

        if ($order->info['shipping_cost'] > 0) {
            $orderLines[] = $this->getOrderShippingLine($order);
        }

        return $orderLines;
    }

    /**
     * @param $order
     * @return array
     */
    public function getOrderShippingLine($order)
    {
        return [
            'quantity' => 1,
            'amount' => $this->getAmountInCents($order->info['shipping_cost'] + $order->info['shipping_tax']),
            'name' => $order->info['shipping_method'],
            'type' => 'shipping_fee',
            'currency' => 'EUR',
            'vat_percentage' => $this->getAmountInCents($this->calculateShippingTax($order)),
            'merchant_order_line_id' => count($order->products) + 1
        ];
    }

    /**
     * @param $order
     * @return float|int
     */
    public function calculateShippingTax($order)
    {
        return ($order->info['shipping_tax'] * 100) / $order->info['shipping_cost'];
    }

    /**
     * Check for availability in the current zone.
     *
     * @return null
     */
    public function update_status()
    {
        return $this->updateModuleVisibility(MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_ZONE);
    }

    /**
     * Check if Klarna Pay Later payment method is limited to specific set of IPs.
     *
     * @return mixed
     */
    function emsKlarnaPayLaterIpFiltering()
    {
        $emsKlarnaPayLaterIpList = MODULE_PAYMENT_EMSPAY_KLARNAPAYLATER_IP_FILTERING;

        if (strlen($emsKlarnaPayLaterIpList) > 0) {
            $ip_whitelist = array_map('trim', explode(",", $emsKlarnaPayLaterIpList));
            if (!in_array($_SESSION['customers_ip_address'], $ip_whitelist)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Set Klarna Pay Later order as 'Shipped' in EMS Online.
     *
     * @param string $emsOrderId
     */
    public function captureKlarnaPayLaterOrder($emsOrderId)
    {
        $ems_order = $this->emspay->getOrder($emsOrderId);
        $transaction_id = !empty(current($ems_order['transactions'])) ? current($ems_order['transactions'])['id'] : null;
        $this->emspay->captureOrderTransaction($ems_order['id'], $transaction_id);
    }

    /**
     * @param $orderId
     * @param $status
     * @param $comments
     * @param $customerNotified
     * @param $orderStatus
     */
    public function _doStatusUpdate($orderId, $status, $comments, $customerNotified, $orderStatus)
    {
        if ($status == (int) MODULE_PAYMENT_EMSPAY_ORDER_STATUS_SHIPPED) {
            $orderHistory = $this->getOrderHistory($orderId);
            $emsOrderId = $this->searchHistoryForOrderKey($orderHistory);
            if ($emsOrderId) {
                $this->captureKlarnaPayLaterOrder($emsOrderId);
            }
        }
    }

    /**
     * Obtain EMS Online order id from order history.
     *
     * @param array $orderHistory
     * @return string|null
     */
    public function searchHistoryForOrderKey(array $orderHistory)
    {
        foreach ($orderHistory as $history) {
            preg_match('/\w{8}-\w{4}-\w{4}-\w{4}-\w{12}/', $history['comments'], $orderKey);
            if (count($orderKey) > 0) {
                return $orderKey[0];
            }
        }
        return null;
    }
}
