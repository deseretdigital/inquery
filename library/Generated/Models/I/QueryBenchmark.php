<?php

/**
 * QueryBenchmark
 *
 * Generated class file for table inquery.query_benchmark
 * Any changes here will be overridden.
 */
abstract class Generated_Models_I_QueryBenchmark extends DDM_Db_Table
{

    /**
     * Meta data cache to avoid describes at run time
     */
    protected $_metadata = array(
        'id' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'query_benchmark',
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
        'query_id' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'query_benchmark',
            'COLUMN_NAME' => 'query_id',
            'COLUMN_POSITION' => 2,
            'DATA_TYPE' => 'int',
            'DEFAULT' => null,
            'NULLABLE' => false,
            'LENGTH' => null,
            'SCALE' => null,
            'PRECISION' => null,
            'UNSIGNED' => true,
            'PRIMARY' => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY' => false
            ),
        'hash' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'query_benchmark',
            'COLUMN_NAME' => 'hash',
            'COLUMN_POSITION' => 3,
            'DATA_TYPE' => 'varchar',
            'DEFAULT' => null,
            'NULLABLE' => false,
            'LENGTH' => '32',
            'SCALE' => null,
            'PRECISION' => null,
            'UNSIGNED' => null,
            'PRIMARY' => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY' => false
            ),
        'time' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'query_benchmark',
            'COLUMN_NAME' => 'time',
            'COLUMN_POSITION' => 4,
            'DATA_TYPE' => 'decimal',
            'DEFAULT' => null,
            'NULLABLE' => false,
            'LENGTH' => null,
            'SCALE' => '5',
            'PRECISION' => '10',
            'UNSIGNED' => null,
            'PRIMARY' => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY' => false
            )
        );

    /**
     * Table name
     */
    protected $_name = 'query_benchmark';

    /**
     * Does this table have Auto Increment?
     */
    protected $_sequence = true;

    /**
     * Fields in db
     */
    protected $_cols = array(
        'id',
        'query_id',
        'hash',
        'time'
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
        $select->from('query_benchmark');
        $select->where('id = ?');
        return $this->_db->fetchAll($select, array($id));
    }

    /**
     * Load by queryId
     *
     * @return array
     */
    public function loadByQueryId($queryId)
    {
        $select = parent::getSelect();
        $select->from('query_benchmark');
        $select->where('query_id = ?');
        return $this->_db->fetchAll($select, array($queryId));
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
                $o = new Models_I_QueryBenchmark();
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
     * @return QueryBenchmark
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
     * Set the QueryId property
     *
     * @param int $QueryId
     * @return QueryBenchmark
     */
    public function setQueryId($queryId)
    {
        $this->_ddm_data['query_id'] = (int) $queryId;
        return $this;
    }

    /**
     * Get queryId
     */
    public function getQueryId()
    {
        if( isset($this->_ddm_data['query_id']) ) {
            return $this->_ddm_data['query_id'];
        } else {
            return null;
        }
    }

    /**
     * Set the Hash property
     *
     * @param string $Hash
     * @return QueryBenchmark
     */
    public function setHash($hash)
    {
        $this->_ddm_data['hash'] = (string) $hash;
        return $this;
    }

    /**
     * Get hash
     */
    public function getHash()
    {
        if( isset($this->_ddm_data['hash']) ) {
            return $this->_ddm_data['hash'];
        } else {
            return null;
        }
    }

    /**
     * Set the Time property
     *
     * @param float $Time
     * @return QueryBenchmark
     */
    public function setTime($time)
    {
        $this->_ddm_data['time'] = (float) $time;
        return $this;
    }

    /**
     * Get time
     */
    public function getTime()
    {
        if( isset($this->_ddm_data['time']) ) {
            return $this->_ddm_data['time'];
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
