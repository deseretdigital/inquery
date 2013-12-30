<?php

/**
 * Query
 *
 * Generated class file for table inquery.query
 * Any changes here will be overridden.
 */
abstract class Generated_Models_I_Query extends DDM_Db_Table
{

    /**
     * Meta data cache to avoid describes at run time
     */
    protected $_metadata = array(
        'id' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'query',
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
        'project_id' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'query',
            'COLUMN_NAME' => 'project_id',
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
            'IDENTITY' => false,
            'REFERENCED_TABLE_NAME' => 'project'
            ),
        'is_original' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'query',
            'COLUMN_NAME' => 'is_original',
            'COLUMN_POSITION' => 3,
            'DATA_TYPE' => 'tinyint',
            'DEFAULT' => null,
            'NULLABLE' => false,
            'LENGTH' => null,
            'SCALE' => null,
            'PRECISION' => null,
            'UNSIGNED' => null,
            'PRIMARY' => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY' => false
            ),
        'title' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'query',
            'COLUMN_NAME' => 'title',
            'COLUMN_POSITION' => 4,
            'DATA_TYPE' => 'varchar',
            'DEFAULT' => null,
            'NULLABLE' => false,
            'LENGTH' => '100',
            'SCALE' => null,
            'PRECISION' => null,
            'UNSIGNED' => null,
            'PRIMARY' => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY' => false
            ),
        'query' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'query',
            'COLUMN_NAME' => 'query',
            'COLUMN_POSITION' => 5,
            'DATA_TYPE' => 'text',
            'DEFAULT' => null,
            'NULLABLE' => false,
            'LENGTH' => null,
            'SCALE' => null,
            'PRECISION' => null,
            'UNSIGNED' => null,
            'PRIMARY' => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY' => false
            ),
        'notes' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'query',
            'COLUMN_NAME' => 'notes',
            'COLUMN_POSITION' => 6,
            'DATA_TYPE' => 'text',
            'DEFAULT' => null,
            'NULLABLE' => true,
            'LENGTH' => null,
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
    protected $_name = 'query';

    /**
     * Does this table have Auto Increment?
     */
    protected $_sequence = true;

    /**
     * Fields in db
     */
    protected $_cols = array(
        'id',
        'project_id',
        'is_original',
        'title',
        'query',
        'notes'
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
     * Get the related Project from inquery.project
     *
     * @return Models_I_Project
     */
    public function getProject()
    {
        if( !$this->getProjectId() )
        {
            return false;
        }
        $obj = new Models_I_Project();
            $obj->loadOne( $this->getProjectId() );
            return $obj;
    }

    /**
     * Load by id
     *
     * @return array
     */
    public function loadById($id)
    {
        $select = parent::getSelect();
        $select->from('query');
        $select->where('id = ?');
        return $this->_db->fetchAll($select, array($id));
    }

    /**
     * Load by projectId
     *
     * @return array
     */
    public function loadByProjectId($projectId)
    {
        $select = parent::getSelect();
        $select->from('query');
        $select->where('project_id = ?');
        return $this->_db->fetchAll($select, array($projectId));
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
                $o = new Models_I_Query();
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
     * @return Query
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
     * Set the ProjectId property
     *
     * @param int $ProjectId
     * @return Query
     */
    public function setProjectId($projectId)
    {
        $this->_ddm_data['project_id'] = (int) $projectId;
        return $this;
    }

    /**
     * Get projectId
     */
    public function getProjectId()
    {
        if( isset($this->_ddm_data['project_id']) ) {
            return $this->_ddm_data['project_id'];
        } else {
            return null;
        }
    }

    /**
     * Set the IsOriginal property (BOOLEAN)
     *
     * @param int $IsOriginal
     * @return Query
     */
    public function setIsOriginal($isOriginal)
    {
        if( $isOriginal === true || $isOriginal == 1 || $isOriginal === 'true' || $isOriginal === 'TRUE' ) {
            $this->_ddm_data['is_original'] = 1;
        } else {
            $this->_ddm_data['is_original'] = 0;
        }
    }

    /**
     * Get isOriginal
     */
    public function getIsOriginal()
    {
        if( isset($this->_ddm_data['is_original']) ) {
            return (boolean) $this->_ddm_data['is_original'];
        } else {
            return null;
        }
    }

    /**
     * Set the Title property
     *
     * @param string $Title
     * @return Query
     */
    public function setTitle($title)
    {
        $this->_ddm_data['title'] = (string) $title;
        return $this;
    }

    /**
     * Get title
     */
    public function getTitle()
    {
        if( isset($this->_ddm_data['title']) ) {
            return $this->_ddm_data['title'];
        } else {
            return null;
        }
    }

    /**
     * Set the Query property
     *
     * @param string $Query
     * @return Query
     */
    public function setQuery($query)
    {
        $this->_ddm_data['query'] = (string) $query;
        return $this;
    }

    /**
     * Get query
     */
    public function getQuery()
    {
        if( isset($this->_ddm_data['query']) ) {
            return $this->_ddm_data['query'];
        } else {
            return null;
        }
    }

    /**
     * Set the Notes property
     *
     * @param string $Notes
     * @return Query
     */
    public function setNotes($notes)
    {
        $value = null;
        if( $notes !== null ) {
            $value = (string) $notes;
        }
        $this->_ddm_data['notes'] =  $value;
        return $this;
    }

    /**
     * Get notes
     */
    public function getNotes()
    {
        if( isset($this->_ddm_data['notes']) ) {
            return $this->_ddm_data['notes'];
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
