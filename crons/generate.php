<?php
$dir = dirname(__FILE__);
require_once $dir . DIRECTORY_SEPARATOR . "cron_common.inc.php";

$targetDbs = 'inquery';
// Someday we can use the zend tools (zf create scaffold, etc) to gen code, but for now this action will do.
$scaffold = new DDM_Scaffold('multidb','master',array('form_class'=>'DDM_BootstrapForm'));
echo "Start generation on default db\n";
$scaffold->generate( PROJECT_ROOT, $targetDbs );
echo "\nFinished\n\n";
exit;
