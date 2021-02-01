<?php

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

require_once(DIR_WS_MODULES.zen_get_module_directory('require_languages.php'));
require_once(DIR_WS_INCLUDES.'classes/class.gingerGateway.php');

$breadcrumb->add(NAVBAR_TITLE);

if ($_POST['processing']) {
    $gingerOrderId = filter_input(INPUT_GET, 'order_id', FILTER_SANITIZE_STRING);
    $gingerOrder = gingerGateway::getClient()->getOrder($gingerOrderId);

    die(json_encode([
        'redirect' => $gingerOrder['status'] == 'processing'
    ]));
}
