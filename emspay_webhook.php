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
        $emsOrder = $emspay->getOrder($data['order_id']);
        if ($emsOrder) {
            emspayGateway::updateOrderStatus(
                $emsOrder->getMerchantOrderId(),
                emspayGateway::getZenStatusId($emsOrder)
            );
            emspayGateway::addOrderHistory(
                $emsOrder->getMerchantOrderId(),
                emspayGateway::getZenStatusId($emsOrder),
                "Status Changed by EMS Online webhook call"
            );
        }
    } else {
        throw new Exception('Unauthorised action!');
    }
} catch (Exception $exception) {
    die($exception->getMessage());
}
