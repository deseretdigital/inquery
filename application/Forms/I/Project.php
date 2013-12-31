<?php
class Forms_I_Project extends Generated_Forms_I_Project {

    public function __construct() {
        parent::__construct(null, 'vertical');
        $this->disableCsrf();
        $this->tweakType('I_name', 'Text');
        $this->removeElement('I_archived');
    }

    public function process($request) {
        $processed = parent::process($request);
        if($request->isPost() && !$request->getParam('I_id')) {
            $Query = new Models_I_Query();
            $Query->setProjectId($processed);
            $Query->setTitle($request->getParam('I_title'));
            $Query->setIsOriginal(true);
            $Query->save();
        }
        return $processed;
    }
}
