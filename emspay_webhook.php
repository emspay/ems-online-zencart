<?php

require_once('includes/application_top.php');
require_once('includes/classes/gateways/class.gingerGateway.php');

try {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!is_array($data)) {
        throw new Exception('Invalid JSON!');
    }

    $ginger = gingerGateway::getClient();

    if ($data['event'] == 'status_changed') {
        $gingerOrder = $ginger->getOrder($data['order_id']);
        if ($gingerOrder) {
            gingerGateway::updateOrderStatus(
                $gingerOrder['merchant_order_id'],
                gingerGateway::getZenStatusId($gingerOrder)
            );
            gingerGateway::addOrderHistory(
               $gingerOrder['merchant_order_id'],
                gingerGateway::getZenStatusId($gingerOrder),
                "Status Changed by EMS Online webhook call"
            );
        }
    } else {
        throw new Exception('Unauthorised action!');
    }
} catch (Exception $exception) {
    die($exception->getMessage());
}
