<?php

/**
 * QueryBenchmark
 *
 * Generated class file for table inquery.query_benchmark
 * Any changes here will be overridden.
 */
abstract class Generated_Forms_I_QueryBenchmark extends DDM_BootstrapForm
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
        
        $I_query_id = new Zend_Form_Element_Select( 'I_query_id',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Query'
                )
        );
        $I_query_id->setAttrib('maxlength', '20');
        
        $this->addElement($I_query_id);
        
        $I_hash = new Zend_Form_Element_Text( 'I_hash',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Hash'
                )
        );
        $I_hash->setAttrib('maxlength', '32');
        
        $I_hash->addValidator('stringLength', false, array(0, 32));
        $this->addElement($I_hash);
        
        $I_time = new Zend_Form_Element_Text( 'I_time',
            array(
                'filters' => array('StringTrim'),
                'label' => 'Time'
                )
        );
        $I_time->setAttrib('maxlength', '15');
        
        $this->addElement($I_time);
        
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
        $redirector->setGotoUrl('/querybenchmark/list');
    }

    /**
     * Get the corresponding model
     *
     * @return Models_I_QueryBenchmark
     */
    protected function getModel()
    {
        // get a model
        $model = new Models_I_QueryBenchmark();
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
