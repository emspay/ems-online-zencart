<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');

/*
 * Class emspay
 */

class emspay extends gingerPaymentDefault
{
    public $code = GINGER_BANK_PREFIX;

    /**
     * Ginger payment library constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Install function.
     *
     * @return null
     */
    public function install()
    {
        global $messageStack;
        $sort_order = 0;

        if (defined('MODULE_PAYMENT_' . strtoupper($this->code) . '_STATUS')) {
            $messageStack->add_session(constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ERROR_ALREADY_INSTALLED), 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module=' . $this->code, 'SSL'));
            return 'failed';
        }
        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _STATUS_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _STATUS_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_STATUS',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => $sort_order,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);
        $sort_order += 1;

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _API_KEY_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _API_KEY_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_API_KEY',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => $sort_order
        ]);
        $sort_order += 1;

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _BUNDLE_CA_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _BUNDLE_CA_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_BUNDLE_CA',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => $sort_order,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);
        $sort_order += 1;

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_COMPLETED_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_COMPLETED_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_COMPLETED',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => $sort_order,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
        ]);
        $sort_order += 1;

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_PENDING_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_PENDING_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_PENDING',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => $sort_order,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
        ]);
        $sort_order += 1;

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_ERROR_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_ERROR_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_ERROR',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => $sort_order,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
        ]);
        $sort_order += 1;

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_PROCESSING_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_PROCESSING_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_PROCESSING',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => $sort_order,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
        ]);
        $sort_order += 1;

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_CANCELLED_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_CANCELLED_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_CANCELLED',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => $sort_order,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
        ]);
        $sort_order += 1;

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_SHIPPED_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_ . strtoupper($this->code) . _ORDER_STATUS_SHIPPED_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_SHIPPED',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => $sort_order,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
        ]);

        return null;
    }

    public function selection()
    {
        return null;
    }

    /**
     * Returns array of configurable field.
     *
     * @return array
     */
    public function keys(): array
    {
        return array(
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_STATUS',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_API_KEY',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_BUNDLE_CA',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_SORT_ORDER',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_ID',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_COMPLETED',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_PENDING',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_ERROR',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_PROCESSING',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_CANCELLED',
            'MODULE_PAYMENT_' . strtoupper($this->code) . '_ORDER_STATUS_SHIPPED'
        );
    }
}
