<?php

// Load the config falling back to the development options if necessary
$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/features.ini', APPLICATION_ENV);

foreach($config as $option => $value) {
    define('FEATURE_' . strtoupper($option), $value);
}

