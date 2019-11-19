<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/includes/classes/class.ingpspGateway.php');

/**
 * Class ingpsp
 */
class ingpsp extends ingpspGateway
{
    public $code = 'ingpsp';

    /**
     * ingpsp constructor.
     */
    function __construct()
    {
        $this->title = MODULE_PAYMENT_INGPSP_TEXT_TITLE;
        $this->description = MODULE_PAYMENT_INGPSP_TEXT_DESCRIPTION;
        $this->enabled = ((MODULE_PAYMENT_INGPSP_STATUS == 'True')?true:false);

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

        if (defined('MODULE_PAYMENT_INGPSP_STATUS')) {
            $messageStack->add_session('INGPSP module already installed.', 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module='.$this->code, 'SSL'));
            return 'failed';
        }

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_STATUS_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_STATUS_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_STATUS',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => 1,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_API_KEY_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_API_KEY_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_API_KEY',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => 3
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_PRODUCT_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_PRODUCT_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_PRODUCT',
            'configuration_value' => '',
            'configuration_group_id' => 6,
            'sort_order' => 4,
            'set_function' => "zen_cfg_select_option(array('kassacompleet', 'ingcheckout', 'epay'), ",
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_BUNDLE_CA_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_BUNDLE_CA_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_BUNDLE_CA',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => 5,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_WEBHOOK_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_WEBHOOK_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_WEBHOOK',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => 6,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_COMPLETED_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_COMPLETED_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_ORDER_STATUS_COMPLETED',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 7,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_PENDING_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_PENDING_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_ORDER_STATUS_PENDING',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 8,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_ERROR_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_ERROR_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_ORDER_STATUS_ERROR',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 9,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_PROCESSING_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_PROCESSING_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_ORDER_STATUS_PROCESSING',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 10,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_CANCELLED_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_CANCELLED_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_ORDER_STATUS_CANCELLED',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 11,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_SHIPPED_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_ORDER_STATUS_SHIPPED_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_ORDER_STATUS_SHIPPED',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 11,
            'set_function' => "zen_cfg_pull_down_order_statuses(",
            'use_function' => 'zen_get_order_status_name'
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
            'MODULE_PAYMENT_INGPSP_STATUS',
            'MODULE_PAYMENT_INGPSP_API_KEY',
            'MODULE_PAYMENT_INGPSP_PRODUCT',
            'MODULE_PAYMENT_INGPSP_WEBHOOK',
            'MODULE_PAYMENT_INGPSP_BUNDLE_CA',
            'MODULE_PAYMENT_INGPSP_SORT_ORDER',
            'MODULE_PAYMENT_INGPSP_ORDER_STATUS_ID',
            'MODULE_PAYMENT_INGPSP_ORDER_STATUS_COMPLETED',
            'MODULE_PAYMENT_INGPSP_ORDER_STATUS_PENDING',
            'MODULE_PAYMENT_INGPSP_ORDER_STATUS_ERROR',
            'MODULE_PAYMENT_INGPSP_ORDER_STATUS_PROCESSING',
            'MODULE_PAYMENT_INGPSP_ORDER_STATUS_CANCELLED',
            'MODULE_PAYMENT_INGPSP_ORDER_STATUS_SHIPPED'
        );
    }
}
