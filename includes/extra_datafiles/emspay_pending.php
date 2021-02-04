<?php
$file_name = explode('.php',basename(__FILE__))[0];
$prefix = strtoupper(explode("_", $file_name)[0]);

define(constant(FILENAME_.$prefix._PENDING), $prefix.'_pending');
