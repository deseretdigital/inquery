<?php

/**
 * Site
 *
 * Generated class file for table inquery.site
 * Any changes here will be overridden.
 */
abstract class Generated_Models_I_Site extends DDM_Db_Table
{

    /**
     * Meta data cache to avoid describes at run time
     */
    protected $_metadata = array(
        'id' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'site',
            'COLUMN_NAME' => 'id',
            'COLUMN_POSITION' => 1,
            'DATA_TYPE' => 'int',
            'DEFAULT' => null,
            'NULLABLE' => false,
            'LENGTH' => null,
            'SCALE' => null,
            'PRECISION' => null,
            'UNSIGNED' => true,
            'PRIMARY' => true,
            'PRIMARY_POSITION' => 1,
            'IDENTITY' => true
            ),
        'name' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'site',
            'COLUMN_NAME' => 'name',
            'COLUMN_POSITION' => 2,
            'DATA_TYPE' => 'varchar',
            'DEFAULT' => null,
            'NULLABLE' => false,
            'LENGTH' => '40',
            'SCALE' => null,
            'PRECISION' => null,
            'UNSIGNED' => null,
            'PRIMARY' => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY' => false
            )
        );

    /**
     * Table name
     */
    protected $_name = 'site';

    /**
     * Does this table have Auto Increment?
     */
    protected $_sequence = true;

    /**
     * Fields in db
     */
    protected $_cols = array(
        'id',
        'name'
        );

    /**
     * Data array used in getters/setters
     */
    protected $_ddm_data = array();

    /**
     * Fields that make up the Primary Key
     */
    protected $_primary = array('id');

    /**
     * Fields that can only be set on an insert
     */
    protected $_insertOnlyColumns = array();

    /**
     * we have the data
     */
    protected $_metadataCacheInClass = true;

    /**
     * Get an array of primary keys
     */
    public function getPrimaryKeys()
    {
        return $this->_primary;
    }

    /**
     * Load by id
     *
     * @return array
     */
    public function loadById($id)
    {
        $select = parent::getSelect();
        $select->from('site');
        $select->where('id = ?');
        return $this->_db->fetchAll($select, array($id));
    }

    /**
     * Get the table name
     *
     * @return string
     */
    public function getTableName()
    {
        // get the table name
        return $this->_name;
    }

    /**
     * Retun objects from an array of ids
     *
     * @param array
     * @param string
     * @return array
     */
    public function arrayToObjects($data, $key)
    {
        $objs = array();
        if(is_array($data)) {
            $useKey = false;
            if($key === null) {
                $keys = $this->_primary;
                $key = array_pop($keys);
            }
            if(!empty($data[0]) && isset($data[0][$key] ) ) {
                $useKey = true;
            }
            $count = count($data);
            for($i = 0; $i < $count; $i++) {
                if($useKey) {
                    $id = $data[$i][$key];
                } else {
                    $id = $data[$i];
                }
                $o = new Models_I_Site();
                $o->loadOne($id);
                $objs[$id] = $o;
            }
        }
        return $objs;
    }

    /**
     * Load by primary key (into this object)
     *
     * @return array
     */
    public function loadOne($id)
    {
        // load by primary key
        $rs = $this->find( $id);
        if( !$rs->current() ) {
            return array();
        }
        $row = $rs->getRow(0);
        $data = $row->toArray();
        $this->setAll($data);
        return $data;
    }

    /**
     * Set the Id property
     *
     * @param int $Id
     * @return Site
     */
    public function setId($id)
    {
        $this->_ddm_data['id'] = (int) $id;
        return $this;
    }

    /**
     * Get id
     */
    public function getId()
    {
        if( isset($this->_ddm_data['id']) ) {
            return $this->_ddm_data['id'];
        } else {
            return null;
        }
    }

    /**
     * Set the Name property
     *
     * @param string $Name
     * @return Site
     */
    public function setName($name)
    {
        $this->_ddm_data['name'] = (string) $name;
        return $this;
    }

    /**
     * Get name
     */
    public function getName()
    {
        if( isset($this->_ddm_data['name']) ) {
            return $this->_ddm_data['name'];
        } else {
            return null;
        }
    }

    /**
     * Is the primary key(s) set?
     */
    public function pkIsSet()
    {
        if( count($this->_primary) == 0 ) {
            return null;
        }
        $allKeysHaveValues = true;
        foreach( $this->_primary as $c ) {
            if( empty($this->_ddm_data[$c]) ) {
                $allKeysHaveValues = false;
            }
        }
        return $allKeysHaveValues;
    }

    /**
     * Save the data
     */
    public function save(array $data = null)
    {
        $this->setAll($data);
        $tmp = array();
        $key = parent::save($this->_ddm_data);
        if( count($this->getPrimaryKeys() ) == 1 ) {
            if( $this->getId() > 0 && $key == 0 ) {
                $key = $this->getId();
            }
        }
        if( method_exists($this, 'getId') && !$this->getId() > 0 && $key > 0 ) {
            $this->setId( $key );
        }
        
        return $key;
    }


}
