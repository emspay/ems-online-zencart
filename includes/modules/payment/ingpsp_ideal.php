<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/class.emspayGateway.php');

/**
 * Class ingpsp_ideal
 */
class ingpsp_ideal extends ingpspGateway
{
    public $code = 'ingpsp_ideal';

    /**
     * ingpsp_ideal constructor.
     */
    function __construct()
    {
        $this->title = MODULE_PAYMENT_INGPSP_IDEAL_TEXT_TITLE;
        $this->description = MODULE_PAYMENT_INGPSP_IDEAL_TEXT_DESCRIPTION;
        $this->sort_order = MODULE_PAYMENT_INGPSP_IDEAL_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_INGPSP_IDEAL_STATUS == 'True')?true:false);

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

        if (defined('MODULE_PAYMENT_INGPSP_IDEAL_STATUS')) {
            $messageStack->add_session(MODULE_PAYMENT_INGPSP_IDEAL_ERROR_ALREADY_INSTALLED, 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module='.$this->code, 'SSL'));
            return 'failed';
        }

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_IDEAL_STATUS_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_IDEAL_STATUS_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_IDEAL_STATUS',
            'configuration_value' => 'True',
            'configuration_group_id' => 6,
            'sort_order' => 0,
            'set_function' => "zen_cfg_select_option(array('True', 'False'), ",
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_IDEAL_DISPLAY_TITLE_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_IDEAL_DISPLAY_TITLE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_IDEAL_DISPLAY_TITLE',
            'configuration_value' => MODULE_PAYMENT_INGPSP_IDEAL_TEXT_TITLE,
            'configuration_group_id' => 6,
            'sort_order' => 1
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_IDEAL_SORT_ORDER_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_IDEAL_SORT_ORDER_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_IDEAL_SORT_ORDER',
            'configuration_value' => 0,
            'configuration_group_id' => 6,
            'sort_order' => 2
        ]);

        $this->setConfigurationField([
            'configuration_title' => MODULE_PAYMENT_INGPSP_IDEAL_ZONE_TEXT,
            'configuration_description' => MODULE_PAYMENT_INGPSP_IDEAL_ZONE_DESCRIPTION,
            'configuration_key' => 'MODULE_PAYMENT_INGPSP_IDEAL_ZONE',
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
            'MODULE_PAYMENT_INGPSP_IDEAL_DISPLAY_TITLE',
            'MODULE_PAYMENT_INGPSP_IDEAL_STATUS',
            'MODULE_PAYMENT_INGPSP_IDEAL_SORT_ORDER',
            'MODULE_PAYMENT_INGPSP_IDEAL_ZONE'
        );
    }

    /**
     * @return array
     */
    public function selection()
    {
        global $messageStack;

        try {
            $ingIssuers = $this->ingpsp->getIdealIssuers()->toArray();
        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', $exception->getMessage(), 'error');
            return null;
        }

        $issuers = [[]];
        foreach ($ingIssuers as $issuer) {
            $issuers[] = [
                'id' => $issuer['id'],
                'text' => $issuer['name']
            ];
        }

        $fields[] = [
            'title' => MODULE_PAYMENT_INGPSP_IDEAL_ISSUER_SELECT,
            'field' => zen_draw_pull_down_menu('issuer_id', $issuers)
        ];

        return array(
            'id' => $this->code,
            'module' => "<img src='".DIR_WS_IMAGES."emspay/".$this->code.".png' /> ".$this->title,
            'fields' => $fields,
        );
    }

    /**
     * @return string
     */
    public function javascript_validation()
    {
        return
            'if (payment_value == "'.$this->code.'") {'."\n".
            '   var issuer_id = document.checkout_payment.issuer_id.value;'."\n".
            '   if (issuer_id == "") {'."\n".
            '       error_message = error_message + "'.MODULE_PAYMENT_INGPSP_IDEAL_ERROR_ISSUER.'";'."\n".
            '       error = 1;'."\n".
            '   }'."\n".
            '}'."\n";
    }

    /**
     * @return string
     */
    public function process_button()
    {
        $processButton = zen_draw_hidden_field('issuer_id', zen_output_string_protected($_POST['issuer_id']));
        $processButton .= zen_draw_hidden_field(zen_session_name(), zen_session_id());

        return $processButton;
    }

    /**
     * Validate order before processing.
     */
    public function before_process()
    {
        global $messageStack;

        if (array_key_exists('order_id', $_GET)) {
            $this->statusRedirect(filter_input(INPUT_GET, 'order_id', FILTER_SANITIZE_STRING));
        }

        if (empty($this->getIssuerId())) {
            $messageStack->add_session('checkout_payment', MODULE_PAYMENT_INGPSP_IDEAL_ERROR_ISSUER, 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }

    /**
     * Order processing method.
     */
    public function after_process()
    {
        global $order, $messageStack;

        try {
            $ingOrder = $this->ingpsp->createIdealOrder(
                $this->gerOrderTotalInCents($order), // amount in cents
                $this->getCurrency($order),          // currency
                $this->getIssuerId(),                // ideal_issuer_id
                $this->getOrderDescription(),        // order description
                $this->getOrderId(),                 // merchantOrderId
                $this->getReturnUrl(),               // returnUrl
                null,                                // expiration
                $this->getCustomerInfo($order),      // customer
                $this->getPluginVersion(),           // extra information
                $this->getWebhookUrl()               // webhook_url
            );

            zen_redirect($ingOrder->firstTransactionPaymentUrl()->toString());

            if ($ingOrder->status()->isError()) {
                $messageStack->add_session('checkout_payment', MODULE_PAYMENT_INGPSP_IDEAL_ERROR_TRANSACTION, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', $exception->getMessage(), 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }

    /**
     * @return string
     */
    public function getIssuerId()
    {
        return zen_output_string_protected($_POST['issuer_id']);
    }

    /**
     * Check for availability in the current zone.
     *
     * @return null
     */
    public function update_status()
    {
        return $this->updateModuleVisibility(MODULE_PAYMENT_INGPSP_IDEAL_ZONE);
    }
}
