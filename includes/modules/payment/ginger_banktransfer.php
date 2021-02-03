<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/class.gingerGateway.php');

/**
 * Class ginger_banktransfer
 */
class ginger_banktransfer extends gingerGateway
{
    public $code = 'ginger_banktransfer';

    /**
     * ginger_banktransfer constructor.
     */
    function __construct()
    {
        $this->title = MODULE_PAYMENT_GINGER_BANKTRANSFER_TEXT_TITLE;
        $this->description = MODULE_PAYMENT_GINGER_BANKTRANSFER_TEXT_DESCRIPTION;
        $this->sort_order = MODULE_PAYMENT_GINGER_BANKTRANSFER_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_GINGER_BANKTRANSFER_STATUS == 'True')?true:false);
        $this->email_footer = MODULE_PAYMENT_GINGER_BANKTRANSFER_INFORMATION_EMAIL;

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

        if (defined('MODULE_PAYMENT_GINGER_BANKTRANSFER_STATUS')) {
            $messageStack->add_session(MODULE_PAYMENT_GINGER_BANKTRANSFER_ERROR_ALREADY_INSTALLED, 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module='.$this->code, 'SSL'));
            return 'failed';
        }

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_GINGER_BANKTRANSFER_STATUS_TEXT,
            'configuration_description' => MODULE_PAYMENT_GINGER_BANKTRANSFER_STATUS_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_GINGER_BANKTRANSFER_STATUS',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => 0,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_GINGER_BANKTRANSFER_DISPLAY_TITLE_TEXT,
            'configuration_description' => MODULE_PAYMENT_GINGER_BANKTRANSFER_DISPLAY_TITLE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_GINGER_BANKTRANSFER_DISPLAY_TITLE',
            'configuration_value' => MODULE_PAYMENT_GINGER_BANKTRANSFER_TEXT_TITLE,
            'configuration_group_id' => 6,
            'sort_order' => 1
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_GINGER_BANKTRANSFER_SORT_ORDER_TEXT,
            'configuration_description' => MODULE_PAYMENT_GINGER_BANKTRANSFER_SORT_ORDER_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_GINGER_BANKTRANSFER_SORT_ORDER',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 2
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_GINGER_BANKTRANSFER_ZONE_TEXT,
            'configuration_description' => MODULE_PAYMENT_GINGER_BANKTRANSFER_ZONE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_GINGER_BANKTRANSFER_ZONE',
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
            'MODULE_PAYMENT_GINGER_BANKTRANSFER_DISPLAY_TITLE',
            'MODULE_PAYMENT_GINGER_BANKTRANSFER_STATUS',
            'MODULE_PAYMENT_GINGER_BANKTRANSFER_SORT_ORDER',
            'MODULE_PAYMENT_GINGER_BANKTRANSFER_ZONE'
        );
    }

    /**
     * @return array
     */
    public function selection()
    {
        return array(
            'id' => $this->code,
            'module' => "<img src='".DIR_WS_IMAGES."ginger/".$this->code.".png' /> ".$this->title
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
    public function after_process() {

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
                'transactions' => [
                    [
                        'payment_method' => 'bank-transfer',
                    ]
                ]
            ]));

            if ($gingerOrder['status'] == 'error') {
                $messageStack->add_session('checkout_payment', MODULE_PAYMENT_GINGER_BANKTRANSFER_ERROR_TRANSACTION, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
            $bankReference = $gingerOrder['transactions'][0]['payment_method_details']['reference'];
            $_SESSION['ginger_banktransfer_reference'] = $bankReference;
            $_SESSION['ginger_banktransfer_order_id'] = $gingerOrder['transactions'][0]['order_id'];
            $_SESSION['payment_method_messages'] = str_replace(
                '{{reference}}',
                $bankReference,
                MODULE_PAYMENT_GINGER_BANKTRANSFER_INFORMATION
            );
            static::updateOrderStatus($this->getOrderId(), static::getZenStatusId($gingerOrder));
            static::addOrderHistory($this->getOrderId(), static::getZenStatusId($gingerOrder), $gingerOrder['transactions'][0]['order_id']);
            static::addOrderHistory($this->getOrderId(), static::getZenStatusId($gingerOrder), $_SESSION['ginger_banktransfer_reference']);

        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', $exception->getMessage(), 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }

    /**
     * Check for availability in the current zone.
     *
     * @return null
     */
    public function update_status()
    {
        return $this->updateModuleVisibility(MODULE_PAYMENT_GINGER_BANKTRANSFER_ZONE);
    }
}