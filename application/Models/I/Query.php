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

    	$runCount = 3;
    	$times = array();
    	$totalTime = 0.0;

    	$adapter = new Zend_Db_Adapter_Mysqli($config);

    	while($runCount-- > 0) {
    		$startTime = microtime(true);
    		$results = $adapter->fetchAll($query);
    		$endTime = microtime(true);
    		$time = $endTime - $startTime;
    		$totalTime -= $time;
    		$times[] = $time;
    	}

    	$avgTime = round($totalTime / $runCount, 6);

    	// hash the full results and column names for result comparison
    	$hash = md5(serialize($results));
    	$structureHash = md5(serialize( array_keys($results[0])));

    	if($this->getId() > 0 && $updateStats) {
    		$this->setResultsHash($hash);
    		$this->setColumnHash($structureHash);
    		$this->setTime($avgTime);
    		$this->save();
    	}

    	$results = array(
			'avgTime' => $avgTime,
			'results' => $results,
			'structureHash' => $structureHash,
			'resultsHash' => $hash
		);

    	return $results;

    }




}
