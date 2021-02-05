<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');

/**
 * Class emspay_applepay
 */
class emspay_applepay extends emspayGateway
{
    public $code = 'applepay';

    /**
     * emspay_applepay constructor.
     */
    function __construct()
    {
        $this->code = implode("_",[GINGER_BANK_PREFIX,$this->code]);
        $this->title = constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_TEXT_TITLE);
        $this->description = constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_TEXT_DESCRIPTION);
        $this->sort_order = constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_SORT_ORDER);
        $this->enabled = ((constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_STATUS) == 'True') ? true : false);

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

        if (defined('MODULE_PAYMENT_'.strtoupper(GINGER_BANK_PREFIX).'_APPLEPAY_STATUS')) {
            $messageStack->add_session(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_ERROR_ALREADY_INSTALLED, 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module='.$this->code, 'SSL'));
            return 'failed';
        }

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_STATUS_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_STATUS_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_'.strtoupper(GINGER_BANK_PREFIX).'_APPLEPAY_STATUS',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => 0,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_DISPLAY_TITLE_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_DISPLAY_TITLE_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_'.strtoupper(GINGER_BANK_PREFIX).'_APPLEPAY_DISPLAY_TITLE',
            'configuration_value' => constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_TEXT_TITLE),
            'configuration_group_id' => 6,
            'sort_order' => 1
        ]);

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_SORT_ORDER_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_SORT_ORDER_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_'.strtoupper(GINGER_BANK_PREFIX).'_APPLEPAY_SORT_ORDER',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 2
        ]);

        $this->setConfigurationField([
            'configuration_title' => constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_ZONE_TEXT),
            'configuration_description' => constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_ZONE_DESCRIPTION),
            'configuration_key' => 'MODULE_PAYMENT_'.strtoupper(GINGER_BANK_PREFIX).'_APPLEPAY_ZONE',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 3,
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
            'MODULE_PAYMENT_'.strtoupper(GINGER_BANK_PREFIX).'_APPLEPAY_DISPLAY_TITLE',
            'MODULE_PAYMENT_'.strtoupper(GINGER_BANK_PREFIX).'_APPLEPAY_STATUS',
            'MODULE_PAYMENT_'.strtoupper(GINGER_BANK_PREFIX).'_APPLEPAY_SORT_ORDER',
            'MODULE_PAYMENT_'.strtoupper(GINGER_BANK_PREFIX).'_APPLEPAY_ZONE'
        );
    }

    /**
     * @return array
     */
    public function selection()
    {
        return array(
            'id' => $this->code,
            'module' =>  "<img src='".DIR_WS_IMAGES.GINGER_BANK_PREFIX."/". $this->code . ".png' /> " . $this->title
        );
    }

    /**
     * Validate order before processing.
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
        $this->getPaymentLink($order,$messageStack);
    }

    /**
     * Check for availability in the current zone.
     *
     * @return null
     */
    public function update_status()
    {
        return $this->updateModuleVisibility(constant(MODULE_PAYMENT_.strtoupper(GINGER_BANK_PREFIX)._APPLEPAY_ZONE));
    }
}
