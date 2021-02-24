<?php

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

$autoLoadConfig[1][] = array(
    'autoType' => 'class',
    'loadFile' => 'observers/class.ginger_email_reference.php'
);

$autoLoadConfig[1][] = array(
    'autoType' => 'classInstantiate',
    'className' => 'ginger_email_reference',
    'objectName' => 'ginger_email_reference'
);