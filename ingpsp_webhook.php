<?php

require_once('includes/application_top.php');
require_once('includes/classes/class.ingpspGateway.php');

try {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!is_array($data)) {
        throw new Exception('Invalid JSON!');
    }

    $ingpsp = ingpspGateway::getClient();

    if ($data['event'] == 'status_changed') {
        $ingOrder = $ingpsp->getOrder($data['order_id']);
        if ($ingOrder) {
            ingpspGateway::updateOrderStatus(
                $ingOrder->getMerchantOrderId(),
                ingpspGateway::getZenStatusId($ingOrder)
            );
            ingpspGateway::addOrderHistory(
                $ingOrder->getMerchantOrderId(),
                ingpspGateway::getZenStatusId($ingOrder),
                "Status Changed by ING PSP webhook call"
            );
        }
    } else {
        throw new Exception('Unauthorised action!');
    }
} catch (Exception $exception) {
    die($exception->getMessage());
}
