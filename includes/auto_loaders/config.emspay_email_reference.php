<?php

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

$autoLoadConfig[1][] = array(
    'autoType' => 'class',
    'loadFile' => 'observers/class.emspay_email_reference.php'
);

$autoLoadConfig[1][] = array(
    'autoType' => 'classInstantiate',
    'className' => 'ingpsp_email_reference',
    'objectName' => 'ingpsp_email_reference'
);
