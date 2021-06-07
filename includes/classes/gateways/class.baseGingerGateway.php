<?php

/**
 * Base Ginger Gateway
 * The {bank_name}Gateway class must extend this one and if needed override some methods.
 */
class baseGingerGateway extends base
{
    /**
     * Module version.
     *
     * @var string
     */
    public $moduleVersion = '1.3.2';

    /**
     * @var /Ginger/ApiClient Ginger Payments SDK client
     */
    protected $ginger;

    /**
     * @var string
     */
    protected $method;

    public $code;

    public static function getClient()
    {
        $apiKey = gingerGateway::getApiKey();
        return is_null($apiKey) ? null : Ginger\Ginger::createClient(
            GINGER_BANK_ENDPOINT,
            $apiKey,
            constant(MODULE_PAYMENT_ . strtoupper(GINGER_BANK_PREFIX) . _BUNDLE_CA) == 'True' ?
                [
                    CURLOPT_CAINFO => gingerGateway::getCaCertPath()
                ] : []
        );
    }

    /**
     * Check if AfterPay payment method is limited to specific set of IPs.
     *
     * @param $order
     * @return mixed
     */
    public function gingerAfterPayCountriesValidation($order): bool
    {
        $gingerAfterPayCountriesList = constant(MODULE_PAYMENT_ . strtoupper($this->code) . _COUNTRIES_AVAILABLE);
        if (empty($gingerAfterPayCountriesList)) {
            return true;
        } else {
            $countrylist = array_map("trim", explode(',', $gingerAfterPayCountriesList));
            return in_array($order->billing['country']['iso_code_2'], $countrylist);
        }
    }

    public function gingerCurrenciesValidation($order): bool
    {
        global $messageStack;

        $order_currency = $order->info['currency'];
        try{
        $this->ginger = $this->getClient();
        $currencies = $this->ginger->getCurrencyList();
        $ginger_available_currency = $currencies['payment_methods'][GINGER_PAYMENT_MAPPING[$this->getMethodNameFromCode()]]['currencies'];
        if (in_array($order_currency, $ginger_available_currency)) {
            return true;
        } else {
            $messageStack->add_session('checkout_payment', 'Some payment methods is not supported for selected currency', 'caution');
            return false;
        }
        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', 'Error while applying currency check, message : '.$exception->getMessage(), 'warning');
            exit;
        }
    }

    /**
     * Get Ideal Issuers and create a html dropdown.
     *
     * @return array|null
     */
    public function getIdealFields()
    {
        global $messageStack;

        try {
            $gingerIssuers = $this->ginger->getIdealIssuers();
        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', $exception->getMessage(), 'error');
            return null;
        }

        $issuers = [];
        foreach ($gingerIssuers as $issuer) {
            array_push($issuers, [
                'id' => $issuer['id'],
                'text' => $issuer['name']
            ]);
        }

        return [
            'title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ISSUER_SELECT),
            'field' => zen_draw_pull_down_menu('issuer_id', $issuers)
        ];
    }


    /**
     * Get selected IssuerId from checkout page
     *
     * @return string
     */
    public function getIssuerId()
    {
        return zen_output_string_protected($_POST['issuer_id']);
    }

    /**
     * Get custom fields for AfterPay payment method for checkout page
     *
     * @return array[]
     */
    public function getAfterPayFields(): array
    {
        global $order;

        return [
            [
                'title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _DOB),
                'field' => zen_draw_input_field($this->code . '_dob')
            ], [
                'title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _GENDER),
                'field' => zen_draw_pull_down_menu(
                    $this->code . '_gender',
                    [
                        ['id' => '', 'text' => ''],
                        ['id' => 'male', 'text' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _MALE)],
                        ['id' => 'female', 'text' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _FEMALE)]
                    ]
                )
            ],
            [
                'title' => sprintf('%s <a href="%s">%s</a>', constant(MODULE_PAYMENT_ . strtoupper($this->code) . _I_ACCEPT), $this->getTermsAndConditionUrlByCountryIso2Code($order->billing['country']['iso_code_2']), constant(MODULE_PAYMENT_ . strtoupper($this->code) . _TERMS_AND_CONDITIONS)),
                'field' => zen_draw_checkbox_field($this->code . '_terms_and_conditions')
            ]
        ];
    }

    /**
     * Save Bank References for BankTransfer order
     *
     * @param $gingerOrder
     */
    public function saveBankReferences($gingerOrder)
    {
        $bankReference = $gingerOrder['transactions'][0]['payment_method_details']['reference'];
        $_SESSION[$this->code . '_reference'] = $bankReference;
        $_SESSION[$this->code . '_order_id'] = $gingerOrder['transactions'][0]['order_id'];
        $_SESSION['payment_method_messages'] = str_replace(
            '{{reference}}',
            $bankReference,
            constant(MODULE_PAYMENT_ . strtoupper($this->code) . _INFORMATION)
        );
    }

    /**
     * Method clears off the cart.
     */
    protected function emptyCart()
    {
        global $order_total_modules;

        $_SESSION['cart']->reset(true);

        unset($_SESSION['sendto']);
        unset($_SESSION['billto']);
        unset($_SESSION['shipping']);
        unset($_SESSION['payment']);
        unset($_SESSION['comments']);
        unset($_SESSION['cot_gv']);

        $order_total_modules->clear_posts();
    }

    /**
     * Initiate EMS Online API client.
     *
     * @param string $code
     * @return \Ginger\ApiClient
     */
    public static function getApiKey($code = GINGER_BANK_PREFIX)
    {
        if (strlen(MODULE_PAYMENT_GINGER_KLARNA_TEST_API_KEY) === 32 && $code == 'emspay_klarnapaylater') {
            $apiKey = MODULE_PAYMENT_GINGER_KLARNA_TEST_API_KEY;
        } elseif (strlen(MODULE_PAYMENT_GINGER_AFTERPAY_TEST_API_KEY) === 32 && $code == 'emspay_afterpay') {
            $apiKey = MODULE_PAYMENT_GINGER_AFTERPAY_TEST_API_KEY;
        } else {
            $apiKey = constant(MODULE_PAYMENT_ . strtoupper(GINGER_BANK_PREFIX) . _API_KEY);
        }
        return strlen($apiKey) == 32 ? $apiKey : null;
    }

    /**
     *  Getting CaCert path
     */

    public static function getCaCertPath()
    {
        return dirname(__DIR__) . '/vendors/assets/cacert.pem';
    }

    /**
     * Check if AfterPay payment method is limited to specific set of IPs.
     *
     * @return mixed
     */
    public function gingerAfterPayIpFiltering()
    {
        $gingerAfterPayIpList = constant(MODULE_PAYMENT_ . ($this->code) . _IP_FILTERING);

        if (strlen($gingerAfterPayIpList) > 0) {
            $ip_whitelist = array_map('trim', explode(",", $gingerAfterPayIpList));
            if (!in_array($_SESSION['customers_ip_address'], $ip_whitelist)) {
                return false;
            }
        }

        return true;
    }

    public function getInfoForGingerOrder($order)
    {
        return array_filter(
            [
                'amount' => $this->gerOrderTotalInCents($order),                                                     // amount in cents
                'currency' => $this->getCurrency($order),                                                            // currency
                'description' => $this->getOrderDescription(),                                                       // order description
                'merchant_order_id' => (string)$this->getOrderId(),                                                  // merchantOrderId
                'return_url' => $this->getReturnUrl(),                                                               // returnUrl
                'customer' => $this->getCustomerInfo($order),                                                        // customer
                'extra' => $this->getPluginVersion(),                                                                // extra information
                'webhook_url' => $this->getWebhookUrl(),                                                             // webhook_url
                'order_lines' => $this->isRequiredOrderLines() ? $this->getOrderLines($order) : null,                // order lines
                'transactions' => array_filter([
                    array_filter([
                        'payment_method' => GINGER_PAYMENT_MAPPING[$this->getMethodNameFromCode()],
                        'payment_method_details' => $this->getPaymentDetails()
                    ])
                ])
            ]);
    }

    /**
     * Get Ginger order
     *
     * @return mixed
     */
    public function getGingerOrder()
    {
        global $order, $messageStack;

        try {
            $ginger_order = $this->ginger->createOrder($this->getInfoForGingerOrder($order));

            if ($this->isRequiredOrderLines()) {
                $this->saveOrderInHistory($ginger_order);
            }

            switch ($ginger_order['status']) {
                case 'error' :
                    $messageStack->add_session(
                        'checkout_payment',
                        $ginger_order['transactions'][0]['customer_message'] ?? constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ERROR_TRANSACTION),
                        'error'
                    );
                    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
                    break;
                case 'canceled' :
                    $messageStack->add_session(
                        'checkout_payment',
                        constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ERROR_TRANSACTION_IS_CANCELLED),
                        'error'
                    );
                    break;
                default :
                    //Return the array, response, from Ginger API
                    return $ginger_order;
            }
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        } catch (Exception $exception) {
            $messageStack->add_session(
                'checkout_payment',
                $exception->getMessage(),
                'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }

    public function getPaymentDetails()
    {
        switch ($this->getMethodNameFromCode()) {
            case 'ideal' :
                return [
                    'issuer_id' => (string)$this->getIssuerId()
                ];
            default :
                return null;
        }
    }

    /**
     * Simple exploding payment code to extract payment method name.
     *
     * @return string|null
     */
    public function getMethodNameFromCode()
    {
        $method_array = explode('_', $this->code);
        return $this->code == GINGER_BANK_PREFIX ? null : end($method_array);
    }

    /**
     * Save order on ZenCart backend.
     *
     * @param $order
     */
    public function saveOrderInHistory($order)
    {
        static::updateOrderStatus($this->getOrderId(), static::getZenStatusId($order));
        static::addOrderHistory($this->getOrderId(), static::getZenStatusId($order), $order['transactions'][0]['order_id']);
    }

    /**
     * @param $order
     * @return int
     */
    public function gerOrderTotalInCents($order): int
    {
        return (int)round($order->info['total'] * 100);
    }

    /**
     * @param $amount
     * @return int
     */
    public function getAmountInCents($amount): int
    {
        return (int)round($amount * 100);
    }

    /**
     * Get order currency.
     *
     * @param $order
     * @return mixed
     */
    public function getCurrency($order)
    {
        return $order->info['currency'];
    }

    /**
     * Generate order description.
     *
     * @return string
     */
    public function getOrderDescription(): string
    {
        return sprintf(constant('MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_DESCRIPTION'), $this->getOrderId(), TITLE);
    }

    /**
     * Return additional_adress
     *
     * @param $order
     * @return array
     */
    public static function getAdditionalAddress($order): array
    {
        return [array_filter([
            'address_type' => 'billing',
            'address' => trim($order->billing['street_address'])
                . ' ' . trim($order->billing['suburb'])
                . ' ' . trim($order->billing['postcode'])
                . ' ' . trim($order->billing['city']),
            'country' => $order->billing['country']['iso_code_2']])];
    }

    /**
     * @param $order
     * @return array
     */
    public function getCustomerInfo($order): array
    {
        $customer = array_filter([
            'address_type' => 'billing',
            'merchant_customer_id' => (string)$_SESSION['customer_id'],
            'email_address' => $order->customer['email_address'],
            'first_name' => $order->customer['firstname'],
            'last_name' => $order->customer['lastname'],
            'address' => trim($order->billing['street_address'])
                . ' ' . trim($order->billing['suburb'])
                . ' ' . trim($order->billing['postcode'])
                . ' ' . trim($order->billing['city']),
            'postal_code' => $order->billing['postcode'],
            'country' => $order->billing['country']['iso_code_2'],
            'phone_numbers' => [$order->customer['telephone']],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'ip_address' => $_SESSION['customers_ip_address'],
            'locale' => $_SESSION['languages_code'],
            $this->isRequiredOrderLines() ? $this->getAdditionalCustomerInfo($order) : null
        ]);

        if ($this->isRequiredOrderLines()) {
            $customer = array_merge($customer, $this->getAdditionalCustomerInfo($order));
        }

        return $customer;
    }

    /**
     * @param $order
     * @return array
     */
    protected function getAdditionalCustomerInfo($order): array
    {
        return [
            'gender' => $this->getCustomPaymentField($this->code . '_gender'),
            'birthdate' => $this->getCustomPaymentField($this->code . '_dob'),
            'additional_address' => $this->getAdditionalAddress($order)
        ];
    }

    /**
     * Method retrieves custom field from POST array.
     *
     * @param string $field
     * @return string|null
     */
    public function getCustomPaymentField(string $field)
    {
        if (array_key_exists($field, $_POST) && strlen($_POST[$field]) > 0) {
            return zen_output_string_protected($_POST[$field]);
        }
        return null;
    }

    /**
     * Generate return URL.
     *
     * @return bool|null|string
     */
    public function getReturnUrl()
    {
        return function_exists('zen_href_link') ? zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL') : 'localhost';
    }

    /**
     * Obtain webhook URL based on site settings.
     *
     * @return string
     */
    public function getWebhookUrl(): string
    {
        if (ENABLE_SSL == 'true') {
            $url = HTTPS_SERVER;
        } else {
            $url = HTTP_SERVER;
        }
        return $url . '/' . 'ginger_webhook.php';
    }

    /**
     * @return array
     */
    public function getPluginVersion(): array
    {
        return [
            'plugin' => "ZenCart v" . $this->moduleVersion
        ];
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return (int)$_SESSION['order_summary']['order_number'];
    }

    /**
     * @param int $orderId
     * @param int $orderStatus
     * @param string $comment
     */
    public static function addOrderHistory(int $orderId, int $orderStatus, $comment = '')
    {
        global $db;

        $sql = "INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . " 
                    (comments, orders_id, orders_status_id, customer_notified, date_added) 
                VALUES 
                    (:orderComments, :orderID, :orderStatus, -1, now());";

        $sql = $db->bindVars($sql, ':orderComments', $comment, 'string');
        $sql = $db->bindVars($sql, ':orderID', $orderId, 'integer');
        $sql = $db->bindVars($sql, ':orderStatus', $orderStatus, 'integer');

        $db->Execute($sql);
    }

    /**
     * Set AfterPay order as 'Shipped' in Bank API.
     *
     * @param string $gingerOrderId
     */
    public function captureAfterPayOrder(string $gingerOrderId)
    {
        $ginger_order = $this->ginger->getOrder($gingerOrderId);
        $transaction_id = !empty(current($ginger_order['transactions'])) ? current($ginger_order['transactions'])['id'] : null;
        $this->ginger->captureOrderTransaction($ginger_order['id'], $transaction_id);
    }

    /**
     * Set Klarna Pay Later order as 'Shipped' in EMS Online.
     *
     * @param string $gingerOrderId
     */
    public function captureKlarnaPayLaterOrder($gingerOrderId)
    {
        $ginger_order = $this->ginger->getOrder($gingerOrderId);
        $transaction_id = !empty(current($ginger_order['transactions'])) ? current($ginger_order['transactions'])['id'] : null;
        $this->ginger->captureOrderTransaction($ginger_order['id'], $transaction_id);
    }

    /**
     * @param int $orderId
     * @param int $orderStatus
     */
    public static function updateOrderStatus(int $orderId, int $orderStatus)
    {
        global $db;

        $sql = "UPDATE " . TABLE_ORDERS . " 
                SET 
                    orders_status = ':orderStatus', 
                    last_modified = NOW()
                WHERE 
                    orders_id = ':orderId';";

        $sql = $db->bindVars($sql, ':orderId', $orderId, 'integer');
        $sql = $db->bindVars($sql, ':orderStatus', $orderStatus, 'integer');

        $db->Execute($sql);
    }

    /**
     * Obtain order history.
     *
     * @param int $orderId
     * @return array
     */
    public function getOrderHistory(int $orderId): array
    {
        global $db;

        $sql = "SELECT * 
                FROM " . TABLE_ORDERS_STATUS_HISTORY . " 
                WHERE `orders_id` = ':orderID';";

        $sql = $db->bindVars($sql, ':orderID', $orderId, 'integer');

        $history = [];
        $historyQuery = $db->Execute($sql);

        while (!$historyQuery->EOF) {
            $history[] = $historyQuery->fields;
            $historyQuery->MoveNext();
        }

        return $history;
    }

    /**
     * Map EMS Online statuses to ZenCart.
     *
     * @param array $ginger_order
     * @return null
     */
    public static function getZenStatusId(array $ginger_order)
    {
        switch ($ginger_order['status']) {
            case 'completed' :
                return constant(MODULE_PAYMENT_ . strtoupper(GINGER_BANK_PREFIX) . _ORDER_STATUS_COMPLETED);
            case 'error' :
                return constant(MODULE_PAYMENT_ . strtoupper(GINGER_BANK_PREFIX) . _ORDER_STATUS_ERROR);
            case 'processing' :
                return constant(MODULE_PAYMENT_ . strtoupper(GINGER_BANK_PREFIX) . _ORDER_STATUS_PROCESSING);
            case 'cancelled' :
                return constant(MODULE_PAYMENT_ . strtoupper(GINGER_BANK_PREFIX) . _ORDER_STATUS_CANCELLED);
            default :
                return constant(MODULE_PAYMENT_ . strtoupper(GINGER_BANK_PREFIX) . _ORDER_STATUS_PENDING);
        }
    }

    /**
     * Depending on order status user is getting redirected and order status is updated.
     *
     * @param string $gingerOrderId
     */
    public function statusRedirect(string $gingerOrderId)
    {
        global $messageStack;

        try {
            $gingerOrder = $this->ginger->getOrder($gingerOrderId);
            static::updateOrderStatus($this->getOrderId(), static::getZenStatusId($gingerOrder));
            static::addOrderHistory($this->getOrderId(), static::getZenStatusId($gingerOrder), $gingerOrder['transactions'][0]['order_id']);
            if ($gingerOrder['status'] == 'completed') {
                $this->emptyCart();
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
            } elseif ($gingerOrder['status'] == 'processing' || $gingerOrder['status'] == 'new') {
                zen_redirect(zen_href_link(FILENAME_GINGER_PENDING, '', 'SSL'));
            } elseif ($gingerOrder['status'] == 'cancelled'
                || $gingerOrder['status'] == 'error'
                || $gingerOrder['status'] == 'expired'
            ) {
                $this->loadLanguageFile(GINGER_BANK_PREFIX);
                $customer_message = $gingerOrder['transactions'][0]['customer_message'] ?: MODULE_PAYMENT_ . strtoupper(GINGER_BANK_PREFIX) . _ERROR_TRANSACTION;
                $messageStack->add_session('checkout_payment', $customer_message, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', $exception->getMessage(), 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }

    /**
     * Method checks for availability in the current zone.
     *
     * @param int $modulePaymentZone
     */
    public function updateModuleVisibility($modulePaymentZone)
    {
        global $order, $db;

        if ($this->enabled && (int)$modulePaymentZone > 0 && isset($order->billing['country']['id'])) {
            $check_flag = false;

            $check_query = $db->Execute(
                "SELECT zone_id FROM "
                . TABLE_ZONES_TO_GEO_ZONES
                . " WHERE geo_zone_id = '"
                . $modulePaymentZone
                . "' AND zone_country_id = '"
                . (int)$order->billing['country']['id']
                . "' ORDER BY zone_id;"
            );

            while (!$check_query->EOF) {
                if ($check_query->fields['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } elseif ($check_query->fields['zone_id'] == $order->billing['zone_id']) {
                    $check_flag = true;
                    break;
                }
                $check_query->MoveNext();
            }

            if ($check_flag == false) {
                $this->enabled = false;
            }
        }
    }

    /**
     * @return null
     */
    public function before_process()
    {
        return null;
    }

    /**
     * @return void
     */
    public function after_process()
    {
        return null;
    }

    /**
     * @return null
     */
    public function selection()
    {
        return null;
    }

    /**
     * @return null
     */
    public function confirmation()
    {
        return null;
    }

    /**
     * @return bool
     */
    public function check_referrer()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function get_error()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function pre_confirmation_check()
    {
        return false;
    }

    /**
     * @return null
     */
    public function javascript_validation()
    {
        return null;
    }

    /**
     * @return null
     */
    public function process_button()
    {
        return null;
    }

    /**
     * @return null
     */
    public function update_status()
    {
        return null;
    }

    protected function isKlarnaPayLater()
    {
        return $this->code == GINGER_BANK_PREFIX . '_klarnapaylater';
    }

    protected function isAfterPay()
    {
        return $this->code == GINGER_BANK_PREFIX . '_afterpay';
    }

    /**
     *
     */
    public function isRequiredOrderLines(): bool
    {
        return in_array($this->getMethodNameFromCode(), ['afterpay', 'klarnapaylater']);
    }

    public function getAmountWithTax($final_price, $tax)
    {
        return $this->getAmountInCents(
            $final_price + zen_calculate_tax($final_price, $tax)
        );
    }

    public function getProductUrl($product_id)
    {
        return zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product_id);
    }

    /**
     * Generate order lines from the order
     *
     * @param order $order
     * @return arrau|null
     */
    public function getOrderLines($order): array
    {
        $orderLines = [];
        foreach ($order->products as $product) {
            $orderLines[] = [
                'name' => (string)$product['name'],
                'currency' => $this->getCurrency($order),
                'type' => 'physical',
                'amount' => $product['amount'] ?? $this->getAmountWithTax($product['final_price'], $product['tax']),
                'vat_percentage' => $this->getAmountInCents($product['tax']),
                'quantity' => (int)$product['qty'],
                'merchant_order_line_id' => (string)$product['id'],
                'url' => $product['url'] ?? $this->getProductUrl($product['id'])
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
    public function getOrderShippingLine($order): array
    {
        return [
            'quantity' => 1,
            'amount' => $this->getAmountInCents($order->info['shipping_cost'] + $order->info['shipping_tax']),
            'name' => $order->info['shipping_method'],
            'type' => 'shipping_fee',
            'currency' => $this->getCurrency($order),
            'vat_percentage' => $this->getAmountInCents($this->calculateShippingTax($order)),
            'merchant_order_line_id' => (string)(count($order->products) + 1)
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
}
