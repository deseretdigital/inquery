<?php

/**
 * Database
 *
 * Generated class file for table inquery.database
 * Any changes here will be overridden.
 */
abstract class Generated_Forms_I_Database extends DDM_BootstrapForm
{

    /**
     * Field prefix
     */
    protected $fieldPrefix = 'I';

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
        
        $I_name = new Zend_Form_Element_Textarea( 'I_name',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Name'
                )
        );
        $I_name->setAttrib('maxlength', '255');
        
        $I_name->addValidator('stringLength', false, array(0, 255));
        $this->addElement($I_name);
        
        $I_db_name = new Zend_Form_Element_Text( 'I_db_name',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Db name'
                )
        );
        $I_db_name->setAttrib('maxlength', '40');
        
        $I_db_name->addValidator('stringLength', false, array(0, 40));
        $this->addElement($I_db_name);
        
        $I_db_user = new Zend_Form_Element_Text( 'I_db_user',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Db user'
                )
        );
        $I_db_user->setAttrib('maxlength', '40');
        
        $I_db_user->addValidator('stringLength', false, array(0, 40));
        $this->addElement($I_db_user);
        
        $I_db_pass = new Zend_Form_Element_Textarea( 'I_db_pass',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Db pass'
                )
        );
        $I_db_pass->setAttrib('maxlength', '255');
        
        $I_db_pass->addValidator('stringLength', false, array(0, 255));
        $this->addElement($I_db_pass);
        
        $I_db_host = new Zend_Form_Element_Textarea( 'I_db_host',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Db host'
                )
        );
        $I_db_host->setAttrib('maxlength', '255');
        
        $I_db_host->addValidator('stringLength', false, array(0, 255));
        $this->addElement($I_db_host);
        
        $I_db_port = new Zend_Form_Element_Text( 'I_db_port',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Db port'
                )
        );
        $I_db_port->setAttrib('maxlength', '6');
        
        $I_db_port->addValidator('stringLength', false, array(0, 6));
        $this->addElement($I_db_port);
        
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
        $redirector->setGotoUrl('/database/list');
    }

    /**
     * Get the corresponding model
     *
     * @return Models_I_Database
     */
    protected function getModel()
    {
        // get a model
        $model = new Models_I_Database();
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
