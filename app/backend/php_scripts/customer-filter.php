<?php
include '../configs/config.php';
include '../core/Config.php';
include '../core/Database.php';
include '../classes/Customer.php';
include '../controllers/invoice_controllers/CustomerController.php';

if(isset( $_GET['customer'] ))
{
    if ($_GET['fieldName'] === 'jobs')
    {
        $jobNames = json_decode($customers_info -> getJobsByCustomer($_GET['customer']), true);

        echo'<option value="" disabled selected hidden></option>';
        foreach ($jobNames as $jobName) {
            echo '<option value="' . $jobName['id'] . '">'. $jobName['name'] . '</option>';
        }

    }
    else if ($_GET['fieldName'] === 'location')
    {
        $locationNames = json_decode($customers_info -> getLocationsByCustomer($_GET['customer']), true);

        echo'<option value="" disabled selected hidden></option>';
        foreach ($locationNames as $locationName) {
            echo '<option value="' . $locationName['id'] . '">'. $locationName['name'] . '</option>';
        }
    }
}

if(isset( $_GET['location'] ))
{
    if ($_GET['fieldName'] === 'customer')
    {
        $customerNames = json_decode($customers_info -> getCustomersByLocation($_GET['location']), true);

        echo'<option value="" disabled selected hidden></option>';
        foreach ($customerNames as $customerName) {
            echo '<option value="' . $customerName['id'] . '">'. $customerName['name'] . '</option>';
        }
    }
    else if ($_GET['fieldName'] === 'jobs')
    {
        $jobNames = json_decode($customers_info -> getJobsByLocation($_GET['location']), true);

        echo'<option value="" disabled selected hidden></option>';
        foreach ($jobNames as $jobName) {
            echo '<option value="' . $jobName['id'] . '">'. $jobName['name'] . '</option>';
        }
    }
}

if(isset( $_GET['jobs'] ))
{

    if ($_GET['fieldName'] === 'customer')
    {
        $jobNames = json_decode($customers_info -> getCustomerByJob($_GET['jobs']), true);

        echo'<option value="" disabled selected hidden></option>';
        foreach ($jobNames as $jobName) {
            echo '<option value="' . $jobName['id'] . '">'. $jobName['name'] . '</option>';
        }
    }
    else if ($_GET['fieldName'] === 'location')
    {
        $locationNames = json_decode($customers_info -> getLocationsByJob($_GET['jobs']), true);

        echo'<option value="" disabled selected hidden></option>';
        foreach ($locationNames as $locationName) {
            echo '<option value="' . $locationName['id'] . '">'. $locationName['name'] . '</option>';
        }
    }
}
