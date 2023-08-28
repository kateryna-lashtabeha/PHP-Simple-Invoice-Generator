<?php

include '../configs/config.php';
include '../core/Config.php';
include '../core/Database.php';
include '../classes/Truck.php';
include '../controllers/invoice_controllers/TruckController.php';

if(isset( $_GET['truck'] ))
{

    if ($_GET['fieldName'] === 'rate')
    {
        $colName = $_GET['truck'][0] === 'hourly' ? 'hourly_rate' : 'fixed_rate';

        $rate = json_decode($trucks_info -> getRate($colName, $_GET['truck'][1]), true);

        echo '<label class="w-100">Rate($)
            <input name="truck-rate" type="text" class="truckRate form-control" value="'.$rate[0][$colName].'" disabled>
        </label>';
    }
}
