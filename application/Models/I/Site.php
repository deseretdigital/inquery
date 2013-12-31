<?php

/**
 * Model for inquery.site
 * This is where you can add and override functions
 */
class Models_I_Site extends Generated_Models_I_Site
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


}
