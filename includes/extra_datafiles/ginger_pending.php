<?php
$file_name = explode('.php',basename(__FILE__))[0];
$prefix = explode("_", $file_name)[0];
define(FILENAME_.strtoupper($prefix)._PENDING, $prefix.'_pending');
