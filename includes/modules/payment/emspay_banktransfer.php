<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/class.emspayGateway.php');

/**
 * Class emspay_banktransfer
 */
class emspay_banktransfer extends emspayGateway
{
    public $code = 'emspay_banktransfer';

    /**
     * emspay_banktransfer constructor.
     */
    function __construct()
    {
        $this->title = MODULE_PAYMENT_EMSPAY_BANKTRANSFER_TEXT_TITLE;
        $this->description = MODULE_PAYMENT_EMSPAY_BANKTRANSFER_TEXT_DESCRIPTION;
        $this->sort_order = MODULE_PAYMENT_EMSPAY_BANKTRANSFER_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_EMSPAY_BANKTRANSFER_STATUS == 'True')?true:false);
        $this->email_footer = MODULE_PAYMENT_EMSPAY_BANKTRANSFER_INFORMATION_EMAIL;

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

        if (defined('MODULE_PAYMENT_EMSPAY_BANKTRANSFER_STATUS')) {
            $messageStack->add_session(MODULE_PAYMENT_EMSPAY_BANKTRANSFER_ERROR_ALREADY_INSTALLED, 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module='.$this->code, 'SSL'));
            return 'failed';
        }

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_EMSPAY_BANKTRANSFER_STATUS_TEXT,
            'configuration_description' => MODULE_PAYMENT_EMSPAY_BANKTRANSFER_STATUS_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_EMSPAY_BANKTRANSFER_STATUS',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => 0,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_EMSPAY_BANKTRANSFER_DISPLAY_TITLE_TEXT,
            'configuration_description' => MODULE_PAYMENT_EMSPAY_BANKTRANSFER_DISPLAY_TITLE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_EMSPAY_BANKTRANSFER_DISPLAY_TITLE',
            'configuration_value' => MODULE_PAYMENT_EMSPAY_BANKTRANSFER_TEXT_TITLE,
            'configuration_group_id' => 6,
            'sort_order' => 1
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_EMSPAY_BANKTRANSFER_SORT_ORDER_TEXT,
            'configuration_description' => MODULE_PAYMENT_EMSPAY_BANKTRANSFER_SORT_ORDER_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_EMSPAY_BANKTRANSFER_SORT_ORDER',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 2
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_EMSPAY_BANKTRANSFER_ZONE_TEXT,
            'configuration_description' => MODULE_PAYMENT_EMSPAY_BANKTRANSFER_ZONE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_EMSPAY_BANKTRANSFER_ZONE',
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
            'MODULE_PAYMENT_EMSPAY_BANKTRANSFER_DISPLAY_TITLE',
            'MODULE_PAYMENT_EMSPAY_BANKTRANSFER_STATUS',
            'MODULE_PAYMENT_EMSPAY_BANKTRANSFER_SORT_ORDER',
            'MODULE_PAYMENT_EMSPAY_BANKTRANSFER_ZONE'
        );
    }

    /**
     * @return array
     */
    public function selection()
    {
        return array(
            'id' => $this->code,
            'module' => "<img src='".DIR_WS_IMAGES."emspay/".$this->code.".png' /> ".$this->title
        );
    }

    /**
     * Order processing method.
     */
    public function before_process()
    {
        global $order, $messageStack;

        try {
            $emsOrder = $this->emspay->createSepaOrder(
                $this->gerOrderTotalInCents($order), // amount in cents
                $this->getCurrency($order),          // currency
                [],                                  // payment method details
                $this->getOrderDescription(),        // order description
                $this->getOrderId(),                 // merchantOrderId
                $this->getReturnUrl(),               // returnUrl
                null,                                // expiration
                $this->getCustomerInfo($order),      // customer
                $this->getPluginVersion(),           // extra information
                $this->getWebhookUrl()               // webhook_url
            );

            if ($emsOrder->status()->isError()) {
                $messageStack->add_session('checkout_payment', MODULE_PAYMENT_EMSPAY_BANKTRANSFER_ERROR_TRANSACTION, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }

            $bankReference = $emsOrder->Transactions()->current()->paymentMethodDetails()->reference()->toString();

            $_SESSION['emspay_banktransfer_reference'] = $bankReference;
            $_SESSION['emspay_banktransfer_order_id'] = $emsOrder->getId();
            $_SESSION['payment_method_messages'] = str_replace(
                '{{reference}}',
                $bankReference,
                MODULE_PAYMENT_EMSPAY_BANKTRANSFER_INFORMATION
            );
        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', $exception->getMessage(), 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }

    /**
     * Update merchant order ID after order creation.
     */
    public function after_process()
    {
        $orderData = $this->emspay->getOrder($_SESSION['emspay_banktransfer_order_id']);
        $orderData->merchantOrderId($this->getOrderId());
        $orderData->description($this->getOrderDescription());
        $this->emspay->updateOrder($orderData);

        static::updateOrderStatus($this->getOrderId(), static::getZenStatusId($orderData));
        static::addOrderHistory($this->getOrderId(), static::getZenStatusId($orderData), $_SESSION['emspay_banktransfer_reference']);
        static::addOrderHistory($this->getOrderId(), static::getZenStatusId($orderData), $orderData->getId());
    }

    /**
     * Check for availability in the current zone.
     *
     * @return null
     */
    public function update_status()
    {
        return $this->updateModuleVisibility(MODULE_PAYMENT_EMSPAY_BANKTRANSFER_ZONE);
    }
}
