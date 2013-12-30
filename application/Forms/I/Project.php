<?php
class Forms_I_Project extends Generated_Forms_I_Project {

    public function __construct() {
        parent::__construct(null, 'vertical');
        $this->disableCsrf();
        $this->tweakType('I_name', 'Text');
    }
}
