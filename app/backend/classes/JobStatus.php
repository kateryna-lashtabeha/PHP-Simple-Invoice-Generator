<?php

class JobStatus
{
    private $_db;

    public function __construct($status = null)
    {
        $this->_db = Database::getInstance();
    }

    public function getStatuses()
    {
        return json_encode($JobStatuses = $this->_db->getAll('statuses'));
    }
}

