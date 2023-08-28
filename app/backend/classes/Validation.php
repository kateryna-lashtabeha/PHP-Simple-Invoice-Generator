<?php

class Validation
{
    private $_passed = false,
            $_showErrors = false,
            $_optional = false,
            $_errors = array(),
            $_db     = null;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function error()
    {
        return $this->_errors[0];
    }

    public function resetErrors()
    {
        $this->_errors = array();
    }

    public function passed()
    {
        return $this->_passed;
    }

    public function setPassed($bool)
    {
        return $this->_passed = $bool;
    }

    public function setshowErrors($bool) {
        return $this-> _showErrors = $bool;
    }

    public function getShowErrors() {
        return $this-> _showErrors;
    }

    public function showErrors($message) {
        if ($this->_showErrors) echo $message;
    }

    public function optional()
    {
        return $this->_optional;
    }

    public function validateField($key, $value, $rules) {

        foreach ($rules as $ruleType => $ruleFields) {

            if (in_array($key, $ruleFields)) {
                switch ($ruleType) {
                    case 'required':
                        if (empty($value))
                        {
                            $this->setPassed(false);
                            $this->addError("'$key': Required field is missing");
                            break;
                        }
                        break;

                    case 'integer':
                        if (!empty($value) && !(preg_match('/^[0-9]+$/', $value)))
                        {
                            $this->setPassed(false);
                            $this->addError("'$key': Wrong number format");
                            break;
                        }
                        break;

                    case 'positive-number':
                        if (!empty($value) && $value < 0)
                        {
                            $this->setPassed(false);
                            $this->addError("'$key': Number must be positive");
                            break;
                        }

                    case 'float-number':
                        if (!empty($value) && !preg_match('/^[+-]?[0-9]*\.?[0-9]+$/', $value))
                        {
                            $this->setPassed(false);
                            $this->addError("'$key': Wrong number format");
                            break;
                        }
                        break;

                    case 'string':
                        if (!empty($value) && !is_string($value))
                        {
                            $this->setPassed(false);
                            $this->addError( "'$key':  Wrong field data");
                            break;
                        }
                        break;

                    case 'is-date':
                        if(!empty($value))
                        {
                            $format = "Y-m-d"; // Desired format "YYYY-MM-DD"
                            $date = DateTime::createFromFormat($format, $value);

                            if ($date && $date->format($format) !== $value)
                            {
                                $this->setPassed(false);
                                $this->addError("'$key': The date isn't in the correct format.");
                                break;
                            }
                            break;
                        }
                }
            }
        }
        return null;// Fields are valid
    }

    public function check($source, $items = array())
    {
        $this -> resetErrors();
        $this->setPassed(true);

        foreach ($source as $sourceKey => $sourceValue)  {

            foreach ($items as $ruleType => $ruleFields) {

                if (in_array($sourceKey, $ruleFields)) {
                    $validationResult = $this->validateField($sourceKey, $sourceValue, $items);
                }
            }
        }

        if (empty($this->_errors))
        {
            $this->_passed = true;
        }

        return $this;
    }

}
