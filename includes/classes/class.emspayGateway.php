<?php

require_once('vendors/ems-php/vendor/autoload.php');

/**
 * Class emspay
 */
class emspayGateway extends base
{
    /**
     * Module version.
     *
     * @var string
     */
    public $moduleVersion = '1.0.0';

    /**
     * Payment method code.
     *
     * @var string
     */
    public $code;

    /**
     * Module settings variables.
     *
     * @var string
     */
    public $enabled, $title, $description, $sort_order, $order_status, $email_footer;

    /**
     * EMS Online PHP library.
     *
     * @var \GingerPayments\Payment\Client
     */
    public $emspay;

    /**
     * Default language.
     */
    const EMSPAY_DEFAULT_LANGUAGE = 'english';

    /**
     * emspayGateway constructor.
     */
    function __construct()
    {
        global $order;

        static::loadLanguageFile($this->code);

        if (is_object($order)) {
            $this->update_status();
            if ($this->isKlarna()) {
                $this->enabled = $this->emsKlarnaIpFiltering();
            }
            if ($this->isAfterPay()) {
                $this->enabled = $this->emsAfterPayIpFiltering();
            }
        }

        if ($this->enabled === true) {
            try {
                $this->emspay = static::getClient($this->code);
            } catch (Exception $exception) {
                $this->title .= '<span class="alert">'.$exception->getMessage().'</span>';
            }
            if ($this->emspay === null) {
                $this->title .= '<span class="alert">'.MODULE_PAYMENT_EMSPAY_ERROR_API_KEY.'</span>';
            }
        }
    }

    /**
     * Load translation file based on selected language.
     *
     * @param string $code
     */
    public static function loadLanguageFile($code)
    {
        $language = $_SESSION['language']?:static::EMSPAY_DEFAULT_LANGUAGE;

        require_once(zen_get_file_directory(
            DIR_FS_CATALOG.DIR_WS_LANGUAGES.$language.'/modules/payment/',
            $code.'.php',
            'false'
        ));
    }

    /**
     * Initiate EMS Online API client.
     *
     * @param string $code
     * @return \GingerPayments\Payment\Client
     */
    public static function getClient($code = 'emspay')
    {
        $emspay = null;

        if (strlen(MODULE_PAYMENT_EMSPAY_KLARNA_TEST_API_KEY) === 32 && $code == 'emspay_klarna') {
            $apiKey = MODULE_PAYMENT_EMSPAY_KLARNA_TEST_API_KEY;
        } elseif (strlen(MODULE_PAYMENT_EMSPAY_AFTERPAY_TEST_API_KEY) === 32 && $code == 'emspay_afterpay') {
            $apiKey = MODULE_PAYMENT_EMSPAY_AFTERPAY_TEST_API_KEY;
        } else {
            $apiKey = MODULE_PAYMENT_EMSPAY_API_KEY;
        }

        if (strlen($apiKey) == 32) {
            $emspay = \GingerPayments\Payment\Ginger::createClient(
                $apiKey
            );

            if (MODULE_PAYMENT_EMSPAY_BUNDLE_CA == 'True') {
                $emspay->useBundledCA();
            }
        }

        return $emspay;
    }

    /**
     * Check to see if module is installed.
     *
     * @return boolean
     */
    public function check()
    {
        global $db;

        if (!isset($this->_check)) {
            $check_query = $db->Execute(
                "SELECT `configuration_value` 
                 FROM ".TABLE_CONFIGURATION." 
                 WHERE `configuration_key` = 'MODULE_PAYMENT_".strtoupper($this->code)."_STATUS'"
            );

            $this->_check = $check_query->RecordCount();
        }

        return $this->_check;
    }

    /**
     * Method un-installs the plugin.
     */
    public function remove()
    {
        global $db;

        $db->Execute(
            "DELETE FROM ".TABLE_CONFIGURATION." 
             WHERE configuration_key in ('".implode("', '", $this->keys())."')"
        );
    }

    /**
     * @param array $config
     */
    protected function setConfigurationField(array $config)
    {
        global $db;

        $sql = "INSERT INTO ".TABLE_CONFIGURATION;
        $sql .= ' ('.implode(', ', array_keys($config)).', date_added)';
        $sql .= ' VALUES ("'.implode('", "', array_values($config)).'", now())';

        $db->Execute($sql);
    }

    /**
     * Method clears off the cart.
     */
    protected function emptyCart()
    {
        global $order_total_modules;

        $_SESSION['cart']->reset(true);

        unset($_SESSION['sendto']);
        unset($_SESSION['billto']);
        unset($_SESSION['shipping']);
        unset($_SESSION['payment']);
        unset($_SESSION['comments']);
        unset($_SESSION['cot_gv']);

        $order_total_modules->clear_posts();
    }

    /**
     * @param $order
     * @return int
     */
    public function gerOrderTotalInCents($order)
    {
        return (int) round($order->info['total'] * 100);
    }

    /**
     * @param $amount
     * @return int
     */
    public function getAmountInCents($amount)
    {
        return (int) round($amount * 100);
    }

    /**
     * Get order currency.
     *
     * @param $order
     * @return mixed
     */
    public function getCurrency($order)
    {
        return $order->info['currency'];
    }

    /**
     * Generate order description.
     *
     * @return string
     */
    public function getOrderDescription()
    {
        return sprintf(MODULE_PAYMENT_EMSPAY_ORDER_DESCRIPTION, $this->getOrderId(), TITLE);
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
            'email_address' => $order->customer['email_address'],
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
            'gender' => $this->getCustomPaymentField('emspay_klarna_gender'),
            'birthdate' => $this->getCustomPaymentField('emspay_klarna_dob')
        ]);
    }

    /**
     * Method retrieves custom field from POST array.
     *
     * @param string $field
     * @return string|null
     */
    public function getCustomPaymentField($field)
    {
        if (array_key_exists($field, $_POST) && strlen($_POST[$field]) > 0) {
            return zen_output_string_protected($_POST[$field]);
        }

        return null;
    }

    /**
     * Generate return URL.
     *
     * @return bool|null|string
     */
    public function getReturnUrl()
    {
        return zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
    }

    /**
     * Obtain webhook URL based on site settings.
     *
     * @return null|string
     */
    public function getWebhookUrl()
    {
        if (MODULE_PAYMENT_EMSPAY_WEBHOOK == 'True') {
            if (ENABLE_SSL == 'true') {
                $url = HTTPS_SERVER;
            } else {
                $url = HTTP_SERVER;
            }
            return $url.'/emspay_webhook.php';
        }

        return null;
    }

    /**
     * @return array
     */
    public function getPluginVersion()
    {
        return [
            'plugin' => "ZenCart v".$this->moduleVersion
        ];
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return (int) $_SESSION['order_summary']['order_number'];
    }

    /**
     * @param int $orderId
     * @param int $orderStatus
     * @param string $comment
     */
    public static function addOrderHistory($orderId, $orderStatus, $comment = '')
    {
        global $db;

        $sql = "INSERT INTO ".TABLE_ORDERS_STATUS_HISTORY." 
                    (comments, orders_id, orders_status_id, customer_notified, date_added) 
                VALUES 
                    (:orderComments, :orderID, :orderStatus, -1, now());";

        $sql = $db->bindVars($sql, ':orderComments', $comment, 'string');
        $sql = $db->bindVars($sql, ':orderID', $orderId, 'integer');
        $sql = $db->bindVars($sql, ':orderStatus', $orderStatus, 'integer');

        $db->Execute($sql);
    }

    /**
     * @param int $orderId
     * @param int $orderStatus
     */
    public static function updateOrderStatus($orderId, $orderStatus)
    {
        global $db;

        $sql = "UPDATE ".TABLE_ORDERS." 
                SET 
                    orders_status = ':orderStatus', 
                    last_modified = NOW()
                WHERE 
                    orders_id = ':orderId';";

        $sql = $db->bindVars($sql, ':orderId', $orderId, 'integer');
        $sql = $db->bindVars($sql, ':orderStatus', $orderStatus, 'integer');

        $db->Execute($sql);
    }

    /**
     * Obtain order history.
     *
     * @param int $orderId
     * @return array
     */
    public function getOrderHistory($orderId)
    {
        global $db;

        $sql = "SELECT * 
                FROM ".TABLE_ORDERS_STATUS_HISTORY." 
                WHERE `orders_id` = ':orderID';";

        $sql = $db->bindVars($sql, ':orderID', $orderId, 'integer');

        $history = [];
        $historyQuery = $db->Execute($sql);

        while (!$historyQuery->EOF) {
            $history[] = $historyQuery->fields;
            $historyQuery->MoveNext();
        }

        return $history;
    }

    /**
     * Map EMS Online statuses to ZenCart.
     *
     * @param $emsOrder
     * @return null
     */
    public static function getZenStatusId($emsOrder)
    {
        if ($emsOrder->status()->isCompleted()) {
            return MODULE_PAYMENT_EMSPAY_ORDER_STATUS_COMPLETED;
        }
        if ($emsOrder->status()->isError()) {
            return MODULE_PAYMENT_EMSPAY_ORDER_STATUS_ERROR;
        }
        if ($emsOrder->status()->isProcessing()) {
            return MODULE_PAYMENT_EMSPAY_ORDER_STATUS_PROCESSING;
        }
        if ($emsOrder->status()->isCancelled()) {
            return MODULE_PAYMENT_EMSPAY_ORDER_STATUS_CANCELLED;
        }

        return MODULE_PAYMENT_EMSPAY_ORDER_STATUS_PENDING;
    }

    /**
     * Depending on order status user is getting redirected and order status is updated.
     *
     * @param string $emspayOrderId
     */
    public function statusRedirect($emspayOrderId)
    {
        global $messageStack;

        try {
            $emsOrder = $this->emspay->getOrder($emspayOrderId);

            static::updateOrderStatus($this->getOrderId(), static::getZenStatusId($emsOrder));
            static::addOrderHistory($this->getOrderId(), static::getZenStatusId($emsOrder), $emsOrder->getId());

            if ($emsOrder->status()->isCompleted()) {
                $this->emptyCart();
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
            } elseif ($emsOrder->status()->isProcessing()) {
                zen_redirect(zen_href_link(FILENAME_EMSPAY_PENDING, '', 'SSL'));
            } elseif ($emsOrder->status()->isCancelled()
                || $emsOrder->status()->isError()
                || $emsOrder->status()->isExpired()
            ) {
                static::loadLanguageFile('emspay');
                $reason = $emsOrder->transactions()->current()->getReason()?:MODULE_PAYMENT_EMSPAY_ERROR_TRANSACTION;
                $messageStack->add_session('checkout_payment', $reason, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
        } catch (Exception $exception) {
            $messageStack->add_session('checkout_payment', $exception->getMessage(), 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }

    /**
     * Method checks for availability in the current zone.
     *
     * @param int $modulePaymentZone
     */
    public function updateModuleVisibility($modulePaymentZone)
    {
        global $order, $db;

        if ($this->enabled && (int) $modulePaymentZone > 0 && isset($order->billing['country']['id'])) {
            $check_flag = false;

            $check_query = $db->Execute(
                "SELECT zone_id FROM "
                .TABLE_ZONES_TO_GEO_ZONES
                ." WHERE geo_zone_id = '"
                .$modulePaymentZone
                ."' AND zone_country_id = '"
                .(int) $order->billing['country']['id']
                ."' ORDER BY zone_id;"
            );

            while (!$check_query->EOF) {
                if ($check_query->fields['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } elseif ($check_query->fields['zone_id'] == $order->billing['zone_id']) {
                    $check_flag = true;
                    break;
                }
                $check_query->MoveNext();
            }

            if ($check_flag == false) {
                $this->enabled = false;
            }
        }
    }

    /**
     * @return null
     */
    public function before_process()
    {
        return null;
    }

    /**
     * @return void
     */
    public function after_process()
    {
        return null;
    }

    /**
     * @return null
     */
    public function selection()
    {
        return null;
    }

    /**
     * @return null
     */
    public function confirmation()
    {
        return null;
    }

    /**
     * @return bool
     */
    public function check_referrer()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function get_error()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function pre_confirmation_check()
    {
        return false;
    }

    /**
     * @return null
     */
    public function javascript_validation()
    {
        return null;
    }

    /**
     * @return null
     */
    public function process_button()
    {
        return null;
    }

    /**
     * @return null
     */
    public function update_status()
    {
        return null;
    }
    
    protected function isKlarna()
    {
        return $this->code == 'emspay_klarna';
    }
    
    protected function isAfterPay()
    {
        return $this->code == 'emspay_afterpay';
    }
}