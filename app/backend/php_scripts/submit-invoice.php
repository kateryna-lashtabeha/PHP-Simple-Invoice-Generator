<?php
include '../configs/config.php';
include '../core/Config.php';
include '../core/Database.php';
include '../classes/Validation.php';
include '../classes/Invoice.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$validation = new Validation();
$invoice = new Invoice();

$invoiceRules = $invoice -> getInvoiceValidationRules();

// $test = [
//     "customer"=> "1",
//     "job"=> "2" ,
//     "status"=> "" ,
//     "location"=> "3" ,
//     "orderedBy"=> "dfgdfg" ,
//     "date"=> "2023-08-25" ,
//     "area"=> "werf" ,
//     "description"=> "wewerr" ,
// ];

$response = '<div id="error-message" class="border border-danger text-danger p-2 mb-3">';

// Validation of the fields
foreach ($_POST['project'] as $projectArr) 
{
    $validation -> check($projectArr, $invoiceRules);
    if ($validation -> passed() !== true ) {
        $response =  $response. '<p>' . $validation -> error() . '</p>';
        $printError = true;
        $validation -> setshowErrors(true);
    }
}

foreach ($_POST['labour'] as $labourArr) 
{
    $validation -> check($labourArr, $invoiceRules);
    if ($validation -> passed() !== true ) {
        $response =  $response . '<p>' . $validation -> error() . '</p>';
        $printError = true;
        $validation -> setshowErrors(true);
    }
}

foreach ($_POST['trucks'] as $trucksArr) 
{
    $validation -> check($trucksArr, $invoiceRules);
    if ($validation -> passed() !== true ) {
        $response =  $response. '<p>' . $validation -> error() . '</p>';
        $printError = true;
        $validation -> setshowErrors(true);
    }
}


foreach ($_POST['misc'] as $miscArr) 
{
    $validation -> check($miscArr, $invoiceRules);
    if ($validation -> passed() !== true ) {
        $response =  $response . '<p>' . $validation -> error() . '</p>';
        $printError = true;
        $validation -> setshowErrors(true);
    }
}

$response = $response . '</div>';
if ($validation ->getShowErrors()) {
    $validation -> showErrors($response);
    } else {
        if ($submitInvoice = $invoice -> createInvoice($_POST)) echo "success";
    }

}
