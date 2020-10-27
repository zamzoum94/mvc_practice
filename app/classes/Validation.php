<?php

class Validation{
    private $_errors = array(),
            $_db;

    public function __construct(){
        $this->_db = Db::getInstance();
    }

    public function check($items, $conditions = array()){
        foreach ($conditions as $key=>$rules){
            $value = $items[$key];
            foreach ($rules as $rule=>$need){
                if($rule === "required" && empty($value)){
                    $this->addError("{$key} is required");
                } else if(!empty($value)){
                    switch ($rule){
                        case "min": {
                            if (strlen($value) < $need){
                                $this->addError("{$key} must be at least {$need} characters!");
                            }
                            break;
                        }
                        case "max" : {
                            if (strlen($value) > $need){
                                $this->addError("{$key} must be maximum of {$need} characters!");
                            }
                            break;
                        }
                        case "unique" : {
                            $count = $this->_db->query("SELECT username FROM users WHERE username=?", [$value])->getCount();
                            if($count){
                                $this->addError("{$key} must be unique!");
                            } break;
                        }
                    }
                }
            }
        }
    }

    public function passed(){
        return empty($this->_errors);
    }

    public function getErrors(){
        return $this->_errors;
    }

    public function addError($error){
        $this->_errors[] = $error;
    }
}