<?php

class Labour
{
    private $_db;

    public function __construct($labour = null)
    {
        $this->_db = Database::getInstance();
    }

    public function getAllStaff()
    {
        return json_encode($allStaff = $this->_db->getAll('staff'));
    }

    public function getFilteredPositions($staffId)
    {
        return json_encode($filteredPositions = $this->_db->getWhere('positions', 'staff_id='.$staffId));
    }

    public function getRate($colName, $positionId)
    {
        return json_encode($rateVal = $this->_db->getOneCol($colName, 'positions', 'id='.$positionId ));
    }
}
