<?php

// default timezone so those stupid warnings go away for good
date_default_timezone_set('America/Denver');

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


	protected function _initConfig() {
		$config = new Zend_Config($this->getOptions(), true);
		Zend_Registry::set('config', $config);
		return $config;
	}

	protected function _initView() {
		$view = new Zend_View();
		$view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
		$view->addHelperPath("DDM/View/Helper", "DDM_View_Helper");
		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
		$viewRenderer->setView($view);
		Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
		return $view;
	}

}