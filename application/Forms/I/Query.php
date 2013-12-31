<?php
class Forms_I_Query extends Generated_Forms_I_Query {

    public function __construct() {
        parent::__construct(null, 'vertical');
        $this->removeElement('I_project_id');
        $this->removeElement('I_is_original');
        $this->removeElement('I_results_hash');
        $this->removeElement('I_column_hash');
        $this->removeElement('I_time');
        $this->tweakType('I_title', 'Text');
        $this->getElement('I_query')->setAttrib('class', 'code-mirror');

        $this->getView()->headScript()->appendFile('/js/lib/codemirror-3.20/lib/codemirror.js');
        $this->getView()->headLink()->appendStylesheet('/js/lib/codemirror-3.20/lib/codemirror.css');
        $this->getView()->headScript()->appendFile('/js/lib/codemirror-3.20/mode/sql/sql.js');

        $this->removeElement('Submit');
        $this->addElement('Button', 'Run_Query', array(
            'Label' => 'Run Query',
            'class' => 'btn run-query',
        ));
        $this->addElement('Button', 'Save_Query', array(
            'Label' => 'Save Query',
            'class' => 'btn btn-primary save-query',
        ));
    }
}
