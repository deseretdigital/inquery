<?php
class Forms_I_Project extends Generated_Forms_I_Project {

    public function __construct() {
        parent::__construct(null, 'vertical');
        $this->disableCsrf();
        $order = 0;
        $this->getElement('I_database_id')->setOrder($order++);
        $this->getElement('I_site_id')->setOrder($order++);
        $this->tweakType('I_name', 'Text')->setOrder($order++);
        $this->getElement('Submit')->setOrder($order++);
        $this->removeElement('I_archived');
    }

    public function process($request) {
        $processed = parent::process($request);
        if($request->isPost() && !$request->getParam('I_id')) {
            $Query = new Models_I_Query();
            $Query->setProjectId($processed);
            $Query->setTitle($request->getParam('I_name'));
            $Query->setIsOriginal(true);
            $Query->save();
        }
        return $processed;
    }
}
