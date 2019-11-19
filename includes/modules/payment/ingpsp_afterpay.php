<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/class.emspayGateway.php');

/**
 * Class ingpsp_afterpay
 */
class ingpsp_afterpay extends ingpspGateway
{
    const TERMS_CONDITION_URL_NL = 'https://www.afterpay.nl/nl/algemeen/betalen-met-afterpay/betalingsvoorwaarden';
    const TERMS_CONDITION_URL_BE = 'https://www.afterpay.be/be/footer/betalen-met-afterpay/betalingsvoorwaarden';
    const BE_CT_CODE = 'BE';
    
    protected static $allowedLocales = ['NL', 'BE'];
    
    public $code = 'ingpsp_afterpay';

    /**
     * ingpsp_afterpay constructor.
     */
    public function __construct()
    {
        $this->title = MODULE_PAYMENT_INGPSP_AFTERPAY_TEXT_TITLE;
        $this->description = MODULE_PAYMENT_INGPSP_AFTERPAY_TEXT_DESCRIPTION;
        $this->sort_order = MODULE_PAYMENT_INGPSP_AFTERPAY_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_INGPSP_AFTERPAY_STATUS == 'True')?true:false);

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

        if (defined('MODULE_PAYMENT_INGPSP_AFTERPAY_STATUS')) {
            $messageStack->add_session(MODULE_PAYMENT_INGPSP_AFTERPAY_ERROR_ALREADY_INSTALLED, 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module='.$this->code, 'SSL'));
            return 'failed';
        }

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_AFTERPAY_STATUS_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_AFTERPAY_STATUS_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_AFTERPAY_STATUS',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => 1,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_AFTERPAY_DISPLAY_TITLE_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_AFTERPAY_DISPLAY_TITLE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_AFTERPAY_DISPLAY_TITLE',
            'configuration_value' => MODULE_PAYMENT_INGPSP_AFTERPAY_TEXT_TITLE,
            'configuration_group_id' => 6,
            'sort_order' => 2
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_AFTERPAY_TEST_API_KEY_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_AFTERPAY_TEST_API_KEY_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_AFTERPAY_TEST_API_KEY',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => 3
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_AFTERPAY_IP_FILTERING_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_AFTERPAY_IP_FILTERING_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_AFTERPAY_IP_FILTERING',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => 4
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_AFTERPAY_SORT_ORDER_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_AFTERPAY_SORT_ORDER_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_AFTERPAY_SORT_ORDER',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 5
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_AFTERPAY_ZONE_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_AFTERPAY_ZONE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_AFTERPAY_ZONE',
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
            'MODULE_PAYMENT_INGPSP_AFTERPAY_DISPLAY_TITLE',
            'MODULE_PAYMENT_INGPSP_AFTERPAY_TEST_API_KEY',
            'MODULE_PAYMENT_INGPSP_AFTERPAY_IP_FILTERING',
            'MODULE_PAYMENT_INGPSP_AFTERPAY_STATUS',
            'MODULE_PAYMENT_INGPSP_AFTERPAY_SORT_ORDER',
            'MODULE_PAYMENT_INGPSP_AFTERPAY_ZONE'
        );
    }

    /**
     * @return array
     */
    public function selection()
    {
        global $order;
        
        $fields = [];
         
        if (isset($order->billing['country']['iso_code_2']) && $this->isValidCountry($order->billing['country']['iso_code_2'])) {
            $fields = [
                         [
                             'title' => MODULE_PAYMENT_INGPSP_AFTERPAY_DOB,
                             'field' => zen_draw_input_field('ingpsp_afterpay_dob')
                         ], [
                             'title' => MODULE_PAYMENT_INGPSP_AFTERPAY_GENDER,
                             'field' => zen_draw_pull_down_menu(
                                 'ingpsp_afterpay_gender',
                                 [
                                     ['id' => '', 'text' => ''],
                                     ['id' => 'male', 'text' => MODULE_PAYMENT_INGPSP_AFTERPAY_MALE],
                                     ['id' => 'female', 'text' => MODULE_PAYMENT_INGPSP_AFTERPAY_FEMALE]
                                 ]
                             )
                         ],
                         [
                             'title' => sprintf('%s <a href="%s">%s</a>', MODULE_PAYMENT_INGPSP_AFTERPAY_I_ACCEPT, $this->getTermsAndConditionUrlByCountryIso2Code($order->billing['country']['iso_code_2']), MODULE_PAYMENT_INGPSP_AFTERPAY_TERMS_AND_CONDITIONS),
                             'field' => zen_draw_checkbox_field('ingpsp_afterpay_terms_and_conditions')
                         ]
                     ];
        }

        return [
            'id' => $this->code,
            'fields' => $fields,
            'module' => "<img src='".DIR_WS_IMAGES."emspay/".$this->code.".png' /> ".$this->title
        ];
    }

    /**
     * Method checks is customer billing address allowed
     * 
     * @param string $iso2Code
     * @return bool
     */
    protected function isValidCountry($iso2Code)
    {
        return in_array($iso2Code, self::$allowedLocales);
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
        $processButton = zen_draw_hidden_field('ingpsp_afterpay_dob', $_POST['ingpsp_afterpay_dob']);
        $processButton .= zen_draw_hidden_field('ingpsp_afterpay_gender', $_POST['ingpsp_afterpay_gender']);
        $processButton .= zen_draw_hidden_field('ingpsp_afterpay_terms_and_conditions', $_POST['ingpsp_afterpay_terms_and_conditions']);
        $processButton .= zen_draw_hidden_field(zen_session_name(), zen_session_id());

        return $processButton;
    }

    /**
     * @return string
     */
    public function javascript_validation()
    {
        global $order;
       
        if (!isset($order->billing['country']['iso_code_2']) || !$this->isValidCountry($order->billing['country']['iso_code_2'])) {
            return
                'if (payment_value == "'.$this->code.'") {'."\n".
                '   error_message = error_message + "'.MODULE_PAYMENT_INGPSP_AFTERPAY_ERROR_COUNTRY_IS_NOT_VALID.'";'."\n".
                '   error = 1;'."\n".
                '}'."\n";
        }
        
        return
            'if (payment_value == "'.$this->code.'") {'."\n".
            '   var ingpsp_afterpay_terms_and_conditions = document.checkout_payment.ingpsp_afterpay_terms_and_conditions.checked;'."\n".
            '   var ingpsp_afterpay_gender = document.checkout_payment.ingpsp_afterpay_gender.value;'."\n".
            '   var ingpsp_afterpay_dob = document.checkout_payment.ingpsp_afterpay_dob.value;'."\n".
            '   if (ingpsp_afterpay_gender == "") {'."\n".
            '       error_message = error_message + "'.MODULE_PAYMENT_INGPSP_AFTERPAY_ERROR_GENDER.'";'."\n".
            '       error = 1;'."\n".
            '   }'."\n".
            '   if (ingpsp_afterpay_dob == "") {'."\n".
            '       error_message = error_message + "'.MODULE_PAYMENT_INGPSP_AFTERPAY_ERROR_DOB.'";'."\n".
            '       error = 1;'."\n".
            '   }'."\n".
            '   if (ingpsp_afterpay_terms_and_conditions == false) {'."\n".
            '       error_message = error_message + "'.MODULE_PAYMENT_INGPSP_AFTERPAY_ERROR_TERMS_AND_CONDITIONS.'";'."\n".
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

        if (empty($_POST['ingpsp_afterpay_gender'])) {
            $messageStack->add_session('checkout_payment', MODULE_PAYMENT_INGPSP_AFTERPAY_ERROR_GENDER, 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }

        if (empty($_POST['ingpsp_afterpay_dob'])) {
            $messageStack->add_session('checkout_payment', MODULE_PAYMENT_INGPSP_AFTERPAY_ERROR_DOB, 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }

        if (empty($_POST['ingpsp_afterpay_terms_and_conditions'])) {
            $messageStack->add_session('checkout_payment', MODULE_PAYMENT_INGPSP_AFTERPAY_ERROR_TERMS_AND_CONDITIONS, 'error');
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
            $ingOrder = $this->ingpsp->createAfterPayOrder(
                $this->gerOrderTotalInCents($order), // amount in cents
                $this->getCurrency($order),          // currency
                $this->getOrderDescription(),        // order description
                $this->getOrderId(),                 // merchantOrderId
                $this->getReturnUrl(),               // returnUrl
                null,                                // expiration
                $this->getCustomerInfo($order),      // customer
                $this->getPluginVersion(),           // extra information
                $this->getWebhookUrl(),              // webhook_url
                $this->getOrderLines($order)         // order lines
            );

            static::updateOrderStatus($this->getOrderId(), static::getZenStatusId($ingOrder));
            static::addOrderHistory($this->getOrderId(), static::getZenStatusId($ingOrder), $ingOrder->getId());

            if ($ingOrder->status()->isError()) {
                $messageStack->add_session(
                    'checkout_payment',
                    $ingOrder->transactions()->current()->reason()->toString(),
                    'error'
                );
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            } elseif ($ingOrder->status()->isCancelled()) {
                $messageStack->add_session(
                    'checkout_payment',
                    MODULE_PAYMENT_INGPSP_AFTERPAY_ERROR_TRANSACTION_IS_CANCELLED,
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
                'name' => $product['name'],
                'currency' => \GingerPayments\Payment\Currency::EUR,
                'type' => \GingerPayments\Payment\Order\OrderLine\Type::PHYSICAL,
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
            'type' => \GingerPayments\Payment\Order\OrderLine\Type::SHIPPING_FEE,
            'currency' => \GingerPayments\Payment\Currency::EUR,
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
        return $this->updateModuleVisibility(MODULE_PAYMENT_INGPSP_AFTERPAY_ZONE);
    }

    /**
     * Check if AfterPay payment method is limited to specific set of IPs.
     *
     * @return mixed
     */
    public function ingAfterPayIpFiltering()
    {
        $ingAfterPayIpList = MODULE_PAYMENT_INGPSP_AFTERPAY_IP_FILTERING;

        if (strlen($ingAfterPayIpList) > 0) {
            $ip_whitelist = array_map('trim', explode(",", $ingAfterPayIpList));
            if (!in_array($_SESSION['customers_ip_address'], $ip_whitelist)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Set AfterPay order as 'Shipped' in ING PSP.
     *
     * @param string $ingOrderId
     */
    public function captureAfterPayOrder($ingOrderId)
    {
        $this->ingpsp->setOrderCapturedStatus(
            $this->ingpsp->getOrder($ingOrderId)
        );
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
        if ($status == (int) MODULE_PAYMENT_INGPSP_ORDER_STATUS_SHIPPED) {
            $orderHistory = $this->getOrderHistory($orderId);
            $ingOrderId = $this->searchHistoryForOrderKey($orderHistory);
            if ($ingOrderId) {
                $this->captureAfterPayOrder($ingOrderId);
            }
        }
    }

    /**
     * Obtain ING PSP order id from order history.
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
        return \GingerPayments\Payment\Common\ArrayFunctions::withoutNullValues([
            'address_type' => 'billing',
            'merchant_customer_id' => $_SESSION['customer_id'],
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
            'gender' => $this->getCustomPaymentField('ingpsp_afterpay_gender'),
            'birthdate' => $this->getCustomPaymentField('ingpsp_afterpay_dob')
        ]);
    }
}
