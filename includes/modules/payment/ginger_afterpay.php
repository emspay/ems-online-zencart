<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/class.baseGingerGateway.php');

/**
 * Class ginger_afterpay
 */
class ginger_afterpay extends gingerGateway
{
    const TERMS_CONDITION_URL_NL = 'https://www.afterpay.nl/nl/algemeen/betalen-met-afterpay/betalingsvoorwaarden';
    const TERMS_CONDITION_URL_BE = 'https://www.afterpay.be/be/footer/betalen-met-afterpay/betalingsvoorwaarden';
    const BE_CT_CODE = 'BE';

    public $code = 'ginger_afterpay';

    /**
     * ginger_afterpay constructor.
     */
    public function __construct()
    {
        $this->title = MODULE_PAYMENT_GINGER_AFTERPAY_TEXT_TITLE;
        $this->description = MODULE_PAYMENT_GINGER_AFTERPAY_TEXT_DESCRIPTION;
        $this->sort_order = MODULE_PAYMENT_GINGER_AFTERPAY_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_GINGER_AFTERPAY_STATUS == 'True')?true:false);

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

        if (defined('MODULE_PAYMENT_GINGER_AFTERPAY_STATUS')) {
            $messageStack->add_session(MODULE_PAYMENT_GINGER_AFTERPAY_ERROR_ALREADY_INSTALLED, 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module='.$this->code, 'SSL'));
            return 'failed';
        }

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_GINGER_AFTERPAY_STATUS_TEXT,
            'configuration_description' => MODULE_PAYMENT_GINGER_AFTERPAY_STATUS_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_GINGER_AFTERPAY_STATUS',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => 1,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_GINGER_AFTERPAY_DISPLAY_TITLE_TEXT,
            'configuration_description' => MODULE_PAYMENT_GINGER_AFTERPAY_DISPLAY_TITLE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_GINGER_AFTERPAY_DISPLAY_TITLE',
            'configuration_value' => MODULE_PAYMENT_GINGER_AFTERPAY_TEXT_TITLE,
            'configuration_group_id' => 6,
            'sort_order' => 2
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_GINGER_AFTERPAY_TEST_API_KEY_TEXT,
            'configuration_description' => MODULE_PAYMENT_GINGER_AFTERPAY_TEST_API_KEY_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_GINGER_AFTERPAY_TEST_API_KEY',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => 3
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_GINGER_AFTERPAY_IP_FILTERING_TEXT,
            'configuration_description' => MODULE_PAYMENT_GINGER_AFTERPAY_IP_FILTERING_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_GINGER_AFTERPAY_IP_FILTERING',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => 4
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_GINGER_AFTERPAY_SORT_ORDER_TEXT,
            'configuration_description' => MODULE_PAYMENT_GINGER_AFTERPAY_SORT_ORDER_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_GINGER_AFTERPAY_SORT_ORDER',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 5
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_GINGER_AFTERPAY_ZONE_TEXT,
            'configuration_description' => MODULE_PAYMENT_GINGER_AFTERPAY_ZONE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_GINGER_AFTERPAY_ZONE',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 6,
            'use_function' => 'zen_get_zone_class_title',
            'set_function' => 'zen_cfg_pull_down_zone_classes(',
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_GINGER_AFTERPAY_COUNTRIES_AVAILABLE_TEXT,
            'configuration_description' => MODULE_PAYMENT_GINGER_AFTERPAY_COUNTRIES_AVAILABLE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_GINGER_AFTERPAY_COUNTRIES_AVAILABLE',
            'configuration_value' => 'NL, BE',
            'configuration_group_id' => 6,
            'sort_order' => 7,
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
            'MODULE_PAYMENT_GINGER_AFTERPAY_DISPLAY_TITLE',
            'MODULE_PAYMENT_GINGER_AFTERPAY_TEST_API_KEY',
            'MODULE_PAYMENT_GINGER_AFTERPAY_IP_FILTERING',
            'MODULE_PAYMENT_GINGER_AFTERPAY_STATUS',
            'MODULE_PAYMENT_GINGER_AFTERPAY_SORT_ORDER',
            'MODULE_PAYMENT_GINGER_AFTERPAY_ZONE',
            'MODULE_PAYMENT_GINGER_AFTERPAY_COUNTRIES_AVAILABLE'
        );
    }

    /**
     * @return array
     */
    public function selection()
    {
        $fields = [
            [
                'title' => MODULE_PAYMENT_GINGER_AFTERPAY_DOB,
                'field' => zen_draw_input_field('ginger_afterpay_dob')
            ], [
                'title' => MODULE_PAYMENT_GINGER_AFTERPAY_GENDER,
                'field' => zen_draw_pull_down_menu(
                    'ginger_afterpay_gender',
                    [
                        ['id' => '', 'text' => ''],
                        ['id' => 'male', 'text' => MODULE_PAYMENT_GINGER_AFTERPAY_MALE],
                        ['id' => 'female', 'text' => MODULE_PAYMENT_GINGER_AFTERPAY_FEMALE]
                    ]
                )
            ],
            [
                'title' => sprintf('%s <a href="%s">%s</a>', MODULE_PAYMENT_GINGER_AFTERPAY_I_ACCEPT, $this->getTermsAndConditionUrlByCountryIso2Code($order->billing['country']['iso_code_2']), MODULE_PAYMENT_GINGER_AFTERPAY_TERMS_AND_CONDITIONS),
                'field' => zen_draw_checkbox_field('ginger_afterpay_terms_and_conditions')
            ]
        ];

        return [
            'id' => $this->code,
            'fields' => $fields,
            'module' => "<img src='".DIR_WS_IMAGES."emspay/".$this->code.".png' /> ".$this->title
        ];
    }
    
    /**
     * Resolve Afterpay Terms&Conditions url
     * 
     * @param string $iso2Code
     * @return string
     */
    protected function getTermsAndConditionUrlByCountryIso2Code($iso2Code)
    {
        if ($iso2Code == self::BE_CT_CODE) {
            return self::TERMS_CONDITION_URL_BE;
        }
        return self::TERMS_CONDITION_URL_NL;
    }
    
    /**
     * @return string
     */
    public function process_button()
    {
        $processButton = zen_draw_hidden_field('ginger_afterpay_dob', $_POST['ginger_afterpay_dob']);
        $processButton .= zen_draw_hidden_field('ginger_afterpay_gender', $_POST['ginger_afterpay_gender']);
        $processButton .= zen_draw_hidden_field('ginger_afterpay_terms_and_conditions', $_POST['ginger_afterpay_terms_and_conditions']);
        $processButton .= zen_draw_hidden_field(zen_session_name(), zen_session_id());

        return $processButton;
    }

    /**
     * @return string
     */
    public function javascript_validation()
    {
        return
            'if (payment_value == "'.$this->code.'") {'."\n".
            '   var ginger_afterpay_terms_and_conditions = document.checkout_payment.ginger_afterpay_terms_and_conditions.checked;'."\n".
            '   var ginger_afterpay_gender = document.checkout_payment.ginger_afterpay_gender.value;'."\n".
            '   var ginger_afterpay_dob = document.checkout_payment.ginger_afterpay_dob.value;'."\n".
            '   if (ginger_afterpay_gender == "") {'."\n".
            '       error_message = error_message + "'.MODULE_PAYMENT_GINGER_AFTERPAY_ERROR_GENDER.'";'."\n".
            '       error = 1;'."\n".
            '   }'."\n".
            '   if (ginger_afterpay_dob == "") {'."\n".
            '       error_message = error_message + "'.MODULE_PAYMENT_GINGER_AFTERPAY_ERROR_DOB.'";'."\n".
            '       error = 1;'."\n".
            '   }'."\n".
            '   if (ginger_afterpay_terms_and_conditions == false) {'."\n".
            '       error_message = error_message + "'.MODULE_PAYMENT_GINGER_AFTERPAY_ERROR_TERMS_AND_CONDITIONS.'";'."\n".
            '       error = 1;'."\n".
            '   }'."\n".
            '}'."\n";
    }

    /**
     * @return null|void
     */
    public function before_process()
    {
        global $messageStack;

        if (empty($_POST['ginger_afterpay_gender'])) {
            $messageStack->add_session('checkout_payment', MODULE_PAYMENT_GINGER_AFTERPAY_ERROR_GENDER, 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }

        if (empty($_POST['ginger_afterpay_dob'])) {
            $messageStack->add_session('checkout_payment', MODULE_PAYMENT_GINGER_AFTERPAY_ERROR_DOB, 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }

        if (empty($_POST['ginger_afterpay_terms_and_conditions'])) {
            $messageStack->add_session('checkout_payment', MODULE_PAYMENT_GINGER_AFTERPAY_ERROR_TERMS_AND_CONDITIONS, 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }

    /**
     * Update merchant order ID after order creation.
     */
    public function after_process()
    {
        global $order, $messageStack;
        try {
            $gingerOrder = $this->ginger->createOrder(array_filter([
                'amount' => $this->gerOrderTotalInCents($order),              // amount in cents
                'currency' => $this->getCurrency($order),              // currency
                'description' => $this->getOrderDescription(),         // order description
                'merchant_order_id' => (string) $this->getOrderId(),            // merchantOrderId
                'return_url' => $this->getReturnUrl(),                 // returnUrl
                'customer' => $this->getCustomerInfo($order),          // customer
                'extra' => $this->getPluginVersion(),                  // extra information
                'webhook_url' => $this->getWebhookUrl(),               // webhook_url
                'order_lines' => $this->getOrderLines($order),                // orderlines
                'transactions' => [
                    [
                        'payment_method' => 'afterpay'
                    ]
                ]
            ]));
            static::updateOrderStatus($this->getOrderId(), static::getZenStatusId($gingerOrder));
            static::addOrderHistory($this->getOrderId(), static::getZenStatusId($gingerOrder), $gingerOrder['transactions'][0]['order_id']);

            if ($gingerOrder['status'] == 'error') {
                $messageStack->add_session(
                    'checkout_payment',
                    $gingerOrder['transactions'][0]['reason'],
                    'error'
                );
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            } elseif ($gingerOrder['status'] == 'canceled') {
                $messageStack->add_session(
                    'checkout_payment',
                    MODULE_PAYMENT_GINGER_AFTERPAY_ERROR_TRANSACTION_IS_CANCELLED,
                    'error'
                );
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
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
                'merchant_order_line_id' => (string) $product['id'],
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
        return $this->updateModuleVisibility(MODULE_PAYMENT_GINGER_AFTERPAY_ZONE);
    }

    /**
     * Check if AfterPay payment method is limited to specific set of IPs.
     *
     * @return mixed
     */
    public function gingerAfterPayIpFiltering()
    {
        $gingerAfterPayIpList = MODULE_PAYMENT_GINGER_AFTERPAY_IP_FILTERING;

        if (strlen($gingerAfterPayIpList) > 0) {
            $ip_whitelist = array_map('trim', explode(",", $gingerAfterPayIpList));
            if (!in_array($_SESSION['customers_ip_address'], $ip_whitelist)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if AfterPay payment method is limited to specific set of IPs.
     *
     * @return mixed
     */
    public function gingerAfterPayCountriesValidation($order)
    {
        $gingerAfterPayCountriesList = MODULE_PAYMENT_GINGER_AFTERPAY_COUNTRIES_AVAILABLE;
        if (empty($gingerAfterPayCountriesList)) {
            return true;
        } else {
            $countrylist = array_map("trim", explode(',', $gingerAfterPayCountriesList));
            return in_array($order->billing['country']['iso_code_2'], $countrylist);
        }
    }

    /**
     * Set AfterPay order as 'Shipped' in EMS Online.
     *
     * @param string $gingerOrderId
     */
    public function captureAfterPayOrder($gingerOrderId)
    {
        $ginger_order = $this->ginger->getOrder($gingerOrderId);
        $transaction_id = !empty(current($ginger_order['transactions'])) ? current($ginger_order['transactions'])['id'] : null;
        $this->ginger->captureOrderTransaction($ginger_order['id'], $transaction_id);
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
        if ($status == (int) MODULE_PAYMENT_GINGER_ORDER_STATUS_SHIPPED) {
            $orderHistory = $this->getOrderHistory($orderId);
            $gingerOrderId = $this->searchHistoryForOrderKey($orderHistory);
            if ($gingerOrderId) {
                $this->captureAfterPayOrder($gingerOrderId);
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
    
    /**
     * @param $order
     * @return array
     */
    public function getCustomerInfo($order)
    {
        return array_filter([
            'address_type' => 'billing',
            'merchant_customer_id' => (string) $_SESSION['customer_id'],
            'email_address' => $order->customer['email_address'], //'rejected@afterpay.com'
            'first_name' => $order->customer['firstname'],
            'last_name' => $order->customer['lastname'],
            'address' => trim($order->billing['street_address'])
                .' '.trim($order->billing['suburb'])
                .' '.trim($order->billing['postcode'])
                .' '.trim($order->billing['city']),
            'postal_code' => $order->billing['postcode'],
            'country' => $order->billing['country']['iso_code_2'],
            'phone_numbers' => [$order->customer['telephone']],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'ip_address' => $_SESSION['customers_ip_address'],
            'locale' => $_SESSION['languages_code'],
            'gender' => $this->getCustomPaymentField('ginger_afterpay_gender'),
            'birthdate' => $this->getCustomPaymentField('ginger_afterpay_dob'),
            'additional_address' => self::getAdditionalAddress($order)
        ]);
    }
}
