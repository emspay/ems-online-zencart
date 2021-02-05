<?php

require_once('includes/application_top.php');
require_once('includes/classes/gateways/autoload.php');

try {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!is_array($data)) {
        throw new Exception('Invalid JSON!');
    }
    /**
     * Creating current bank Gateway;
     */
    $Gateway =  new (GINGER_BANK_PREFIX.'Gateway');
    $ginger = $Gateway::getClient();

    if ($data['event'] == 'status_changed') {
        $gingerOrder = $ginger->getOrder($data['order_id']);
        if ($gingerOrder) {
            $Gateway::updateOrderStatus(
                $gingerOrder['merchant_order_id'],
                $Gateway::getZenStatusId($gingerOrder)
            );
            $Gateway::addOrderHistory(
               $gingerOrder['merchant_order_id'],
                $Gateway::getZenStatusId($gingerOrder),
                $Gateway->getWebhookStatusUpdateDescription()
            );
        }
    } else {
        throw new Exception('Unauthorised action!');
    }
} catch (Exception $exception) {
    die($exception->getMessage());
}
