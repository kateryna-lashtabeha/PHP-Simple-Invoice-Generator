<?php

class Customer
{
    private $_db;

    public function __construct($customer = null)
    {
        $this->_db = Database::getInstance();

    }

    public function getAllCustomers()
    {
        return json_encode($allCustomers = $this->_db->getAll('customers'));
    }

    public function getAllJobs()
    {
        return json_encode($allJobs = $this->_db->getAll('jobs'));
    }

    public function getAllLocations()
    {
        return json_encode($allLocations = $this->_db->getAll('locations'));
    }


    public function getJobsByCustomer($customerId)
    {
        return json_encode($filteredJobs = $this->_db->getWhere('jobs', 'customer_id='.$customerId ));
    }

    public function getLocationsByCustomer($customerId)
    {
        return json_encode($filteredLocations = $this->_db->getJoin('locations', 'jobs', 'jobs.customer_id='.$customerId, 'locations ON locations.job_id = jobs.id' ));
    }

    public function getJobsByLocation($locationId)
    {
        return json_encode($filteredJobs = $this->_db->getJoin('jobs', 'locations', 'locations.id='.$locationId, 'jobs ON jobs.id = locations.job_id'));
    }

    public function getCustomersByLocation($locationId)
    {
        return json_encode($filteredCustomers = $this->_db->getJoin(
            'customers', '
            locations',
            'locations.id='.$locationId,
            'jobs ON jobs.id = locations.job_id JOIN customers on customers.id = jobs.customer_id'
        ));
    }

    public function getCustomerByJob($jobId)
    {
        return json_encode($filteredCustomers = $this->_db->getJoin('customers', 'jobs', 'jobs.id ='.$jobId, 'customers ON customers.id = jobs.customer_id' ));
    }

    public function getLocationsByJob($jobId)
    {
        return json_encode($filteredLocations = $this->_db->getJoin('locations', 'jobs', 'jobs.customer_id='.$jobId, 'locations ON jobs.id=locations.job_id' ));
    }

}
