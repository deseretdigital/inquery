<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

$root = realpath(dirname(dirname(__FILE__) )) . '/';
$parts = preg_split('/releases/', $root);
if(count($parts) > 1) {
	$root = $parts[0] . 'current/';
}

defined('PROJECT_ROOT')
    || define('PROJECT_ROOT', $root);

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// -- Define the Include paths for use with Smarty --
set_include_path(implode(PATH_SEPARATOR, array(
    '.',
    PROJECT_ROOT . 'application',
    PROJECT_ROOT . 'library',
    get_include_path()
)));


// -- Configure the Autoloader for use with Smarty --
require_once 'Zend/Loader/Autoloader.php';
$loader = Zend_Loader_Autoloader::getInstance();
$loader->suppressNotFoundWarnings(false);
$loader->setFallbackAutoloader(true);

require('DDM/Functions.php');

// -- Create the application, bootstrap
$application = new Zend_Application( APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');

// what do we need?
$application->getBootstrap()->bootstrap('config');
$application->getBootstrap()->bootstrap('view');
$application->getBootstrap()->bootstrap('multidb');
$multidb = $application->getBootstrap()->getPluginResource('multidb');
$db = $multidb->getDb('master');

// If we're not on a production server and the database is pointing at anything other than localhost,
// make sure the user is aware. We might not intend to run against production or whatever else.
$hostname = gethostname();
$db_host = Zend_Registry::get('config')->resources->multidb->master->host;
if(substr($hostname, 0, 5) != 'dcjob' && $db_host != '127.0.0.1') {
    echo "Not running against local database. DB host is '" . $db_host . "'. Are you sure you want to continue? ";
    $response = readline();
    if(strtolower(substr($response, 0, 1)) != 'y') {
        exit;
    }
}
