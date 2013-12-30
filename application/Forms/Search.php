<?php
class Forms_Search extends DDM_Form {

	protected $hiddenFields = array();

	public function __construct($name = null) {
		$this->disableCsrf();
		parent::__construct($name, 'inline');
		$this->setMethod('get');
		$this->disableAutoSave();

		/*
		$params = parse_qs($_SERVER['QUERY_STRING']);
		unset($params[ $this->getName() . '_csrf']);
		$action = $_SERVER['REQUEST_URI'] . '?' . http_build_query($params);
		$this->setAction($action);
		*/

		$this->hiddenFields = array('key','meta','format','maps');

		foreach($this->hiddenFields as $name) {
			$$name = new Zend_Form_Element_Hidden(array('name' => $name));
			$this->addElement($$name, $name);
		}
		$keepZendDecorators = true;
		$this->addElement('text', 'search', array(
				'class' => 'listSearch',
				'placeholder' => ''
		), $keepZendDecorators );

		$this->addElement('submit', 'go', array(
		), $keepZendDecorators );

	}


	public function populate($request) {

		$populate = $this->hiddenFields;
		$populate[] = 'search';
		foreach($populate as $name) {
			$el = $this->getElement($name);
			$value = $request->getParam($name);
			$el->setValue($value);
		}
	}


}