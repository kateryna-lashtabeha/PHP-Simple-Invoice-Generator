<?php

$customers_info = new Customer();

$customerNames = json_decode($customers_info -> getAllCustomers(), true);

$jobNames = json_decode($customers_info -> getAllJobs(), true);

$locationsNames = json_decode($customers_info -> getAllLocations(), true);
