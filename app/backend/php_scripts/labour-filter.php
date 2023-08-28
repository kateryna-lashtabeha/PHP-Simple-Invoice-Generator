<?php
include '../configs/config.php';
include '../core/Config.php';
include '../core/Database.php';
include '../classes/Labour.php';
include '../controllers/invoice_controllers/LabourController.php';

if(isset( $_GET['staff'] ))
{

    if ($_GET['fieldName'] === 'staff')
    {
        $positions = json_decode($labours -> getFilteredPositions($_GET['staff'][0]), true);

        echo'<option value="" disabled selected hidden></option>';
        foreach ($positions as $position) {
            echo '<option value="' . $position['id'] . '">'. $position['name'] . '</option>';
        }
    }
    else if ($_GET['fieldName'] === 'regular')
    {
        $colName = $_GET['staff'][0] === 'hourly' ? 'hourly_regular_rate' : 'fixed_regular_rate';
        $regularRate = json_decode($labours -> getRate($colName, $_GET['staff'][1]), true);

        echo '<label class="regularRate-wrapper w-100">Regular rate
            <input name="reg-rate" type="text" class="regularRate form-control" value="'.$regularRate[0][$colName].'" disabled>
        </label>';
    }
    else if ($_GET['fieldName'] === 'overtime')
    {
        $colName = $_GET['staff'][0] === 'hourly' ? 'hourly_overtime_rate' : 'fixed_overtime_rate';
        $regularRate = json_decode($labours -> getRate($colName, $_GET['staff'][1]), true);

        echo '<label class="overtimeRate-wrapper w-100">Overtime rate
            <input name="overtime-rate" type="text" class="overtimeRate form-control" value="'.$regularRate[0][$colName].'" disabled>
        </label>';
    }
}
