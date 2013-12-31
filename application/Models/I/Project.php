<?php

/**
 * Model for inquery.project
 * This is where you can add and override functions
 */
class Models_I_Project extends Generated_Models_I_Project
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
        return parent::save( $data );
    }

    /**
     *
     * @param int $projectId
     * @param boolean $returnObject
     * @return Models_I_Query|boolean
     */
    public function getOriginalQuery($projectId = null, $returnObject = true) {

        if(empty($projectId)) {
            $projectId = $this->getId();
        }
        if(empty($projectId)) {
            return false;
        }
        $select = $this->getSelect()
                ->from('query')
                ->where('project_id = ?', $projectId)
                ->where('is_original = 1');
        $row = $this->_db->fetchRow($select);
        if(!$returnObject) {
            return $row;
        }
        $Query = new Models_I_Query();
        $Query->loadOne($row['id']);
        return $Query;
    }
}
