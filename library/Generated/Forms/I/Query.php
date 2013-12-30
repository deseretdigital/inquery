<?php

/**
 * Query
 *
 * Generated class file for table inquery.query
 * Any changes here will be overridden.
 */
abstract class Generated_Forms_I_Query extends DDM_BootstrapForm
{

    /**
     * Field prefix
     */
    protected $fieldPrefix = 'I';

    /**
     * Populate the I_project_idfield
     */
    public function populateProjectId($keyField = 'id', $valueField = 'name')
    {
        $obj = new Models_I_Project();
        $ele = $this->getElement('I_project_id');
        $sql = "SELECT `$keyField`, `$valueField` FROM `". $obj->getTableName() . "` ORDER BY `$valueField`";
        $rows = $obj->getAdapter()->fetchAll($sql);
        if( count($rows) ) {
            $tmp = array();
            foreach($rows as $r) {
                $tmp[ $r[$keyField ] ] = $r[$valueField];
            }
          $ele->addMultiOptions( $tmp );
        }
    }

    /**
     * The constructor
     */
    public function __construct($name = null, $formType = 'horizontal')
    {
        parent::__construct($name,$formType);
        $I_id = new Zend_Form_Element_Hidden( 'I_id',
            array('filters' => array('StringTrim'))
        );
        $this->addElement($I_id);
        
        $I_project_id = new Zend_Form_Element_Select( 'I_project_id',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Project'
                )
        );
        $I_project_id->setAttrib('maxlength', '20');
        
        $this->addElement($I_project_id);
        
        $I_is_original = new Zend_Form_Element_Checkbox( 'I_is_original',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Is original'
                )
        );
        $I_is_original->setAttrib('maxlength', '20');
        
        $this->addElement($I_is_original);
        
        $I_title = new Zend_Form_Element_Textarea( 'I_title',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Title'
                )
        );
        $I_title->setAttrib('maxlength', '255');
        
        $I_title->addValidator('stringLength', false, array(0, 255));
        $this->addElement($I_title);
        
        $I_query = new Zend_Form_Element_Textarea( 'I_query',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Query'
                )
        );
        $I_query->setAttrib('maxlength', '65000');
        
        $I_query->addValidator('stringLength', false, array(0, 65000));
        $this->addElement($I_query);
        
        $I_notes = new Zend_Form_Element_Textarea( 'I_notes',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Notes'
                )
        );
        $I_notes->setAttrib('maxlength', '65000');
        
        $I_notes->addValidator('stringLength', false, array(0, 65000));
        $this->addElement($I_notes);
        
        $this->addElement( 
            'submit',
            'Submit');
    }

    /**
     * What happens after process is successful?
     */
    public function postProcess()
    {
        $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
        $redirector->setGotoUrl('/query/list');
    }

    /**
     * Get the corresponding model
     *
     * @return Models_I_Query
     */
    protected function getModel()
    {
        // get a model
        $model = new Models_I_Query();
        return $model;
    }

    /**
     * Get the corresponding model
     *
     * @param Zend_Request $request
     * @param Zend_Controller $controller
     * @param Zend_Controller $controller
     * @return mixed
     */
    public function process($request)
    {
        // anything to load?
        //ppr($request->getUserParams()); exit;
        $pk = 'id';
        if( ( $loadValue = $request->getParam($pk) ) > 0 ) {
        
            if( $this->canLoad( $pk ) ) {
        
                // load the data for this item
                $model = $this->getModel();
        
                // Zend_Db_Table_Rowset
                $data = $model->find( $loadValue );
                if( $data->count() == 1 ) {
                    // Zend_Db_Table_Row Object
                    $row = $data->current();
                    $data = $row->toArray();
        
                    $populate = array();
                    foreach( $data as $k => $v ) {
                        $populate[ $this->fieldPrefix . '_' . $k ] = $v;
                    }
        
                    $this->populate( $populate ) ;
                }
        
            }
        
        }
        
        // Process Post
        if ($request->isPost()) {
            $data = $request->getParams();
        
            // validate
            if ($this->isValid( $data ) ) {
        
                // grab the filtered values (isValid populated the elemtns, getValues gets filtered values back)
                $data = $this->getValues();
        
                $model = $this->getModel();
                $splitFields = array();
        
                foreach( $data as $key => $d ) {
                    if( strpos( $key, $this->fieldPrefix) === 0 ) {
                        $newKey = str_replace( $this->fieldPrefix . '_', '', $key);
                        if( isset( $splitFields[$newKey]) ) {
                            $appendTo = $splitFields[$newKey];
                            $data[ $appendTo ] .= ' ' . $d;
                            unset($data[$newKey]);
                        } else {
                            $data[ $newKey ] = $d;
                        }
                        unset($data[$key]);
                        //echo "set $newKey set to $d <BR>";
                    } else {
                        //echo "prefix not found in $key <BR>";
                    }
                }
        
                // save if they have permission (or whatever canSave does)
                if( $this->canSave( $data ) ) {
                    $return = $model->save( $data );
                    $this->postProcess( $return );
                    return $return;
                }
            }
        }
        return false;
    }

    /**
     * Can this item be loaded in the form?
     *
     * @return boolean
     */
    protected function canLoad()
    {
        // can this action be performed?
        return true;
    }

    /**
     * Can this item be saved?
     *
     * @return boolean
     */
    protected function canSave($data)
    {
        // can this action be performed?
        return true;
    }


}
