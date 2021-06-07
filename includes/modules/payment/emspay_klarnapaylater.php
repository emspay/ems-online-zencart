<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');

/**
 * Class for iDEAL payment method
 */
class emspay_klarnapaylater extends gingerPaymentDefault
{
    public $code = 'klarnapaylater';

    /**
     * Install function.
     *
     * @return null|string
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
        return array_merge($std_keys, [
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_TEST_API_KEY',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_IP_FILTERING'
        ]);
    }

    /**
     * @return string
     */
    public function process_button()
    {
        return zen_draw_hidden_field(zen_session_name(), zen_session_id());
    }

    /**
     * @param $orderId
     * @param $status
     */
    public function _doStatusUpdate($orderId, $status)
    {
        if ($status == (int)constant(MODULE_PAYMENT_ . strtoupper(GINGER_BANK_PREFIX) . _ORDER_STATUS_SHIPPED)) {
            $orderHistory = $this->getOrderHistory($orderId);
            $gingerOrderId = $this->searchHistoryForOrderKey($orderHistory);
            if ($gingerOrderId) {
                $this->captureKlarnaPayLaterOrder($gingerOrderId);
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
