<?php

class Validate {

    private $_passed = false;

    private $_errors = array();

    public function check($type, array $items) {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $value = $type[$item];

                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required");
                }
                else if (!empty($value)) {
                    switch ($rule) {
                        case 'minlength':
                            if (strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value}");
                            }
                            break;

                        case 'maxlength':
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$item} must be a maximum of {$rule_value}");
                            }
                            break;

                        case 'matches':
                            if ($value != $type[$rule_value]) {
                                $this->addError("{$rule_value} must match {$item}");
                            }
                            break;
                    }
                }
            }
        }

        if (empty($this->_errors)) {
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($error) {
        $this->_errors[] = $error;
    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }

}
