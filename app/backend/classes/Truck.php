<?php

class Truck
{
    private $_db;

    public function __construct($truck = null)
    {
        $this->_db = Database::getInstance();
    }

    public function getAllTrucks()
    {
        return json_encode($allTrucks = $this->_db->getAll('trucks'));
    }

    public function getRate($colName, $truckId)
    {
        return json_encode($rateVal = $this->_db->getOneCol($colName, 'trucks', 'id='.$truckId ));
    }

}