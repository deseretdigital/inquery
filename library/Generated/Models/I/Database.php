<?php

/**
 * Database
 *
 * Generated class file for table inquery.database
 * Any changes here will be overridden.
 */
abstract class Generated_Models_I_Database extends DDM_Db_Table
{

    /**
     * Meta data cache to avoid describes at run time
     */
    protected $_metadata = array(
        'id' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'database',
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
            'TABLE_NAME' => 'database',
            'COLUMN_NAME' => 'name',
            'COLUMN_POSITION' => 2,
            'DATA_TYPE' => 'varchar',
            'DEFAULT' => null,
            'NULLABLE' => false,
            'LENGTH' => '255',
            'SCALE' => null,
            'PRECISION' => null,
            'UNSIGNED' => null,
            'PRIMARY' => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY' => false
            ),
        'db_name' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'database',
            'COLUMN_NAME' => 'db_name',
            'COLUMN_POSITION' => 3,
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
            ),
        'db_user' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'database',
            'COLUMN_NAME' => 'db_user',
            'COLUMN_POSITION' => 4,
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
            ),
        'db_pass' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'database',
            'COLUMN_NAME' => 'db_pass',
            'COLUMN_POSITION' => 5,
            'DATA_TYPE' => 'varchar',
            'DEFAULT' => null,
            'NULLABLE' => false,
            'LENGTH' => '60',
            'SCALE' => null,
            'PRECISION' => null,
            'UNSIGNED' => null,
            'PRIMARY' => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY' => false
            ),
        'db_host' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'database',
            'COLUMN_NAME' => 'db_host',
            'COLUMN_POSITION' => 6,
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
        'db_port' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'database',
            'COLUMN_NAME' => 'db_port',
            'COLUMN_POSITION' => 7,
            'DATA_TYPE' => 'varchar',
            'DEFAULT' => '3306',
            'NULLABLE' => false,
            'LENGTH' => '6',
            'SCALE' => null,
            'PRECISION' => null,
            'UNSIGNED' => null,
            'PRIMARY' => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY' => false
            ),
        'site_id' => array(
            'SCHEMA_NAME' => null,
            'TABLE_NAME' => 'database',
            'COLUMN_NAME' => 'site_id',
            'COLUMN_POSITION' => 8,
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
            'REFERENCED_TABLE_NAME' => 'site'
            )
        );

    /**
     * Table name
     */
    protected $_name = 'database';

    /**
     * Does this table have Auto Increment?
     */
    protected $_sequence = true;

    /**
     * Fields in db
     */
    protected $_cols = array(
        'id',
        'name',
        'db_name',
        'db_user',
        'db_pass',
        'db_host',
        'db_port',
        'site_id'
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
     * Get the related Site from inquery.site
     *
     * @return Models_I_Site
     */
    public function getSite()
    {
        if( !$this->getSiteId() )
        {
            return false;
        }
        $obj = new Models_I_Site();
            $obj->loadOne( $this->getSiteId() );
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
        $select->from('database');
        $select->where('id = ?');
        return $this->_db->fetchAll($select, array($id));
    }

    /**
     * Load by siteId
     *
     * @return array
     */
    public function loadBySiteId($siteId)
    {
        $select = parent::getSelect();
        $select->from('database');
        $select->where('site_id = ?');
        return $this->_db->fetchAll($select, array($siteId));
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
                $o = new Models_I_Database();
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
     * @return Database
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
     * @return Database
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
     * Set the DbName property
     *
     * @param string $DbName
     * @return Database
     */
    public function setDbName($dbName)
    {
        $this->_ddm_data['db_name'] = (string) $dbName;
        return $this;
    }

    /**
     * Get dbName
     */
    public function getDbName()
    {
        if( isset($this->_ddm_data['db_name']) ) {
            return $this->_ddm_data['db_name'];
        } else {
            return null;
        }
    }

    /**
     * Set the DbUser property
     *
     * @param string $DbUser
     * @return Database
     */
    public function setDbUser($dbUser)
    {
        $this->_ddm_data['db_user'] = (string) $dbUser;
        return $this;
    }

    /**
     * Get dbUser
     */
    public function getDbUser()
    {
        if( isset($this->_ddm_data['db_user']) ) {
            return $this->_ddm_data['db_user'];
        } else {
            return null;
        }
    }

    /**
     * Set the DbPass property
     *
     * @param string $DbPass
     * @return Database
     */
    public function setDbPass($dbPass)
    {
        $this->_ddm_data['db_pass'] = (string) $dbPass;
        return $this;
    }

    /**
     * Get dbPass
     */
    public function getDbPass()
    {
        if( isset($this->_ddm_data['db_pass']) ) {
            return $this->_ddm_data['db_pass'];
        } else {
            return null;
        }
    }

    /**
     * Set the DbHost property
     *
     * @param string $DbHost
     * @return Database
     */
    public function setDbHost($dbHost)
    {
        $this->_ddm_data['db_host'] = (string) $dbHost;
        return $this;
    }

    /**
     * Get dbHost
     */
    public function getDbHost()
    {
        if( isset($this->_ddm_data['db_host']) ) {
            return $this->_ddm_data['db_host'];
        } else {
            return null;
        }
    }

    /**
     * Set the DbPort property
     *
     * @param string $DbPort
     * @return Database
     */
    public function setDbPort($dbPort)
    {
        $this->_ddm_data['db_port'] = (string) $dbPort;
        return $this;
    }

    /**
     * Get dbPort
     */
    public function getDbPort()
    {
        if( isset($this->_ddm_data['db_port']) ) {
            return $this->_ddm_data['db_port'];
        } else {
            return null;
        }
    }

    /**
     * Set the SiteId property
     *
     * @param int $SiteId
     * @return Database
     */
    public function setSiteId($siteId)
    {
        $this->_ddm_data['site_id'] = (int) $siteId;
        return $this;
    }

    /**
     * Get siteId
     */
    public function getSiteId()
    {
        if( isset($this->_ddm_data['site_id']) ) {
            return $this->_ddm_data['site_id'];
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
