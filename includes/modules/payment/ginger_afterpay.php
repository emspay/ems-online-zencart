<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');

/**
 * Class for AfterPay payment method
 */
class ginger_afterpay extends gingerPaymentDefault
{
    const TERMS_CONDITION_URL_NL = 'https://www.afterpay.nl/nl/algemeen/betalen-met-afterpay/betalingsvoorwaarden';
    const TERMS_CONDITION_URL_BE = 'https://www.afterpay.be/be/footer/betalen-met-afterpay/betalingsvoorwaarden';
    const BE_CT_CODE = 'BE';

    public $code = 'afterpay';

    /**
     * Install function.
     *
     * @return null
     */
    public function install()
    {
        $sort_order = parent::install();

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _TEST_API_KEY_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _TEST_API_KEY_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_TEST_API_KEY',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => $sort_order
        ]);
        $sort_order += 1;

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _IP_FILTERING_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _IP_FILTERING_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_IP_FILTERING',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => $sort_order
        ]);
        $sort_order += 1;

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _COUNTRIES_AVAILABLE_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _COUNTRIES_AVAILABLE_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_COUNTRIES_AVAILABLE',
            'configuration_value' => 'NL, BE',
            'configuration_group_id' => 6,
            'sort_order' => $sort_order,
        ]);

        return null;
    }

    /**
     * Returns array of configurable field.
     *
     * @return array
     */
    public function keys(): array
    {
        $std_keys = parent::keys();
        return array_merge($std_keys, array(
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_IP_FILTERING',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_TEST_API_KEY',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_COUNTRIES_AVAILABLE'
        ));
    }

    /**
     * Resolve Afterpay Terms&Conditions url
     *
     * @param string $iso2Code
     * @return string
     */
    protected function getTermsAndConditionUrlByCountryIso2Code(string $iso2Code): string
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
        $processButton = zen_draw_hidden_field($this->code . '_dob', $_POST[$this->code . '_dob']);
        $processButton .= zen_draw_hidden_field($this->code . '_gender', $_POST[$this->code . '_gender']);
        $processButton .= zen_draw_hidden_field($this->code . '_terms_and_conditions', $_POST[$this->code . '_terms_and_conditions']);
        $processButton .= zen_draw_hidden_field(zen_session_name(), zen_session_id());

        return $processButton;
    }

    /**
     * @return string
     */
    public function javascript_validation()
    {
        return
            'if (payment_value == "' . $this->code . '") {' . "\n" .
            '   var ' . $this->code . '_terms_and_conditions = document.checkout_payment.' . $this->code . '_terms_and_conditions.checked;' . "\n" .
            '   var ' . $this->code . '_gender = document.checkout_payment.' . $this->code . '_gender.value;' . "\n" .
            '   var ' . $this->code . '_dob = document.checkout_payment.' . $this->code . '_dob.value;' . "\n" .
            '   if (' . $this->code . '_gender == "") {' . "\n" .
            '       error_message = error_message + "' . constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ERROR_GENDER) . '";' . "\n" .
            '       error = 1;' . "\n" .
            '   }' . "\n" .
            '   if (' . $this->code . '_dob == "") {' . "\n" .
            '       error_message = error_message + "' . constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ERROR_DOB) . '";' . "\n" .
            '       error = 1;' . "\n" .
            '   }' . "\n" .
            '   if (' . $this->code . '_terms_and_conditions == false) {' . "\n" .
            '       error_message = error_message + "' . constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ERROR_TERMS_AND_CONDITIONS) . '";' . "\n" .
            '       error = 1;' . "\n" .
            '   }' . "\n" .
            '}' . "\n";
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
        if ($status == (int)constant(MODULE_PAYMENT_ . strtoupper(GINGER_BANK_PREFIX) . _ORDER_STATUS_SHIPPED)) {
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
}
