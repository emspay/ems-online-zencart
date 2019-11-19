<?php

require_once('includes/application_top.php');
require_once('includes/classes/class.emspayGateway.php');

try {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!is_array($data)) {
        throw new Exception('Invalid JSON!');
    }

    $emspay = emspayGateway::getClient();

    if ($data['event'] == 'status_changed') {
        $ingOrder = $emspay->getOrder($data['order_id']);
        if ($ingOrder) {
            emspayGateway::updateOrderStatus(
                $ingOrder->getMerchantOrderId(),
                emspayGateway::getZenStatusId($ingOrder)
            );
            emspayGateway::addOrderHistory(
                $ingOrder->getMerchantOrderId(),
                emspayGateway::getZenStatusId($ingOrder),
                "Status Changed by ING PSP webhook call"
            );
        }
    } else {
        throw new Exception('Unauthorised action!');
    }
} catch (Exception $exception) {
    die($exception->getMessage());
}
