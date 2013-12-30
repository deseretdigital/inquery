<?php
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

$root = realpath(dirname(dirname(__FILE__)));
$parts = preg_split('/releases/', $root);
if(count($parts) > 1) {
	$root = $parts[0] . 'current';
}
defined('PROJECT_ROOT')
    || define('PROJECT_ROOT', $root . '/');

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

if(in_array(APPLICATION_ENV,array('staging_prod','staging')))
{
    defined('HTTP_HOST')
        || define('HTTP_HOST', $_SERVER['HTTP_HOST']);
}

defined('FAMEWORK_ROOT')
    || define('FAMEWORK_ROOT', realpath(dirname(dirname(__FILE__) )) . '/library/DDM/../');

    set_include_path(implode(PATH_SEPARATOR, array(
    '.',
    './../application',
    './../library',
    get_include_path(),
    )));

require('DDM/Functions.php');

// make apache rewrite work with ZF - which doesn't look for REDIRECT_URL
if(isset($_SERVER['REDIRECT_URL'])) {
    $_SERVER['REQUEST_URI'] = $_SERVER['REDIRECT_URL'];
}

// -- Configure the Autoloader for use with Smarty --
require_once 'Zend/Loader/Autoloader.php';
$loader = Zend_Loader_Autoloader::getInstance();
$loader->suppressNotFoundWarnings(false);
$loader->setFallbackAutoloader(true);

// -- Create the application, bootstrap, and run --
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

// Include feature constants
include_once(APPLICATION_PATH . '/configs/features.php');

$application->bootstrap()
            ->run();
