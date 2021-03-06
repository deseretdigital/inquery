<?php

/**
 * Model for inquery.query
 * This is where you can add and override functions
 */
class Models_I_Query extends Generated_Models_I_Query
{

    /**
     * save data
     */
    public function save(array $data = null)
    {
        if( $this->pkIsSet() || (isset($data[ $this->_primary[0]]) && $data[ $this->_primary[0]] != '' ) ) {
            return $this->update( $data );
        } else {
            return $this->insert( $data );
        }
    }

    /**
     * Insert data
     */
    public function insert(array $data = null)
    {
        return parent::save( $data );
    }

    /**
     * Update data
     */
    public function update(array $data = null, $fooVar = null)
    {
        $ret = parent::save( $data );
        return $ret;
    }

    public function setQuery($query) {
        $query = strip_tags($this->getSelect()->beautifySQL($query));
        parent::setQuery($query);
    }

    /**
     * Run a query
     * @param string $query
     * @param boolean $updateStats
     * @throws Exception
     * @return array
     */
    public function runQuery($query = '', $updateStats = false) {

    	if($query == '') {
    		$query = $this->getQuery();
    	}
    	if($query == '') {
    		throw new Exception('run() called without a query.');
    	}

    	// we don't care about cached times
    	$query = str_ireplace('SELECT ', 'SELECT SQL_NO_CACHE ', $query);

    	$project = $this->getProject();
    	$db = $project->getDatabase();

    	$config = new Zend_Config(
    			array(
    					'host'     => $db->getDbHost(),
    					'dbname'   => $db->getDbName(),
    					'username' => $db->getDbUser(),
						'password' => $db->getDbPass(),
    			)
    	);

    	$runs = 3;
    	$times = array();
    	$totalTime = 0.0;
    	$maxTime = 5;

    	$adapter = new Zend_Db_Adapter_Mysqli($config);

    	while($runs-- > 0) {
    		$startTime = microtime(true);
    		$results = $adapter->fetchAll($query);
    		$endTime = microtime(true);
    		$time = $endTime - $startTime;
    		$totalTime += (float) $time;
    		$times[] = $time;
    		// if it is a slow query, don't run it again
    		if($time > $maxTime) {
    			break;
    		}
    	}
    	$avgTime = round($totalTime / count($times), 6);

    	// hash the full results and column names for result comparison
    	$hash = md5(serialize($results));
    	$structureHash = md5(serialize( array_keys($results[0])));

    	if($this->getId() > 0 && $updateStats) {
    		$this->setResultsHash($hash);
    		$this->setColumnHash($structureHash);
    		$this->setTime($avgTime);
    		$this->save();
    	}

        $originalQuery = $project->getOriginalQuery();
    	$results = array(
			'avgTime' => $avgTime,
			'results' => $results,
			'structureHash' => $structureHash,
			'resultsHash' => $hash,
                        'originalStructureHash' => $originalQuery->getColumnHash(),
                        'originalResultsHash' => $originalQuery->getResultsHash()
		);

    	return $results;

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
        $select->order('id');
        return $this->_db->fetchAll($select, array($projectId));
    }

    public function fork() {
        if(!$this->getId()) {
            return false;
        }

        $Query = new Models_I_Query();
        $all = $this->getAll();
        unset($all['id']);
        unset($all['is_original']);
        $all['title'] = 'Forked from - '.$all['title'];
        $all['notes'] = 'Forked from - '.$all['notes'];
        unset($all['results_hash']);
        unset($all['column_hash']);
        unset($all['time']);
        $Query->setAll($all);
        return $Query->save();
    }

}
