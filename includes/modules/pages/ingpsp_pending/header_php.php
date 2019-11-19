<?php

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

require_once(DIR_WS_MODULES.zen_get_module_directory('require_languages.php'));
require_once(DIR_WS_INCLUDES.'classes/class.ingpspGateway.php');

$breadcrumb->add(NAVBAR_TITLE);

if ($_POST['processing']) {
    $ingOrderId = filter_input(INPUT_GET, 'order_id', FILTER_SANITIZE_STRING);
    $ingpspOrder = ingpspGateway::getClient()->getOrder($ingOrderId);

    die(json_encode([
        'redirect' => $ingpspOrder->status()->isProcessing()
    ]));
}
