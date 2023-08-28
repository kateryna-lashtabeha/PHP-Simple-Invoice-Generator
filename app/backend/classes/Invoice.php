<?php

class Invoice
{
    private $_db;

    private const INVOICE_RULES = [
        'required' => ['customer', 'job', 'status', 'location', 'description', 'staff', 'position', 'labour-units',
        'reg-hours', 'reg-rate', 'overtime-rate'],
        'float-number' => ['truck-quantity', 'truck-rate', 'misc-cost', 'misc-price', 'misc-quantity',
            'reg-hours', 'overtime-hours', 'reg-rate', 'overtime-rate'],
        'positive-number' => ['customer', 'job', 'status', 'location', 'staff', 'position',
            'reg-hours', 'overtime-hours', 'reg-rate', 'overtime-rate', 'truck-label', 'truck-quantity', 'truck-rate',
            'misc-cost', 'misc-price', 'misc-quantity'],
        'integer' => ['customer', 'job', 'status', 'location', 'staff', 'position', 'truck-label'],
        'string' => ['description', 'labour-units', 'truck-units'],
        'is-date' => ['date']
    ];

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function getInvoiceValidationRules() {
        return self::INVOICE_RULES;
    }

    public function createInvoice($fields= array())
    {
        $fieldsInvoice = [
            'date' => $fields['project'][0]['date'],
            'ordered_by' => $fields['project'][0]['orderedBy'],
            'area' => $fields['project'][0]['area'],
            'description' => $fields['project'][0]['description'],
            'customer_id' => $fields['project'][0]['customer'],
            'job_id' => $fields['project'][0]['job'],
            'location_id' => $fields['project'][0]['location'],
            'status_id' => $fields['project'][0]['status'],
        ];
        $fieldsLabour = array();
        $fieldsTrucks = array();
        $fieldsMisc = array();

        foreach ($fields['labour'] as $key => $fieldArr)
            {
                $fieldsLabour[$key] = [
                    'staff_id' => $fieldArr['staff'],
                    'position_id' => $fieldArr['position'],
                    'regular_hours' => $fieldArr['reg-hours'],
                    'overtime_hours' => $fieldArr['overtime-hours'],
                    'regular_rate_value' => $fieldArr['reg-rate'],
                    'overtime_rate_value' => $fieldArr['overtime-rate'],
                ];
            };

        foreach ($fields['trucks'] as $key => $fieldArr)
            {
                $fieldsTrucks[$key] = [
                    'overtime_hours' => $fieldArr['truck-label'],
                    'truck_rate' => $fieldArr['truck-rate'],
                    'truck_quantity' => $fieldArr['truck-quantity'],
                ];
            };

        foreach ($fields['misc'] as $key => $fieldArr)
            {
                $fieldsMisc[$key] = [
                    'description' => $fieldArr['misc-descr'],
                    'cost' => $fieldArr['misc-cost'],
                    'price' => $fieldArr['misc-price'],
                    'quantity' => $fieldArr['misc-quantity'],
                ];
            };


        if ($this->_db->insertMultipleTables('invoices', $fieldsInvoice, [
                'invoice_labours' => $fieldsLabour,
                'invoice_misc' => $fieldsMisc,
                'invoice_trucks' =>  $fieldsTrucks
        ]))
        {
            return true;
        }
        else
        {
            return false;
        }

    }
}
