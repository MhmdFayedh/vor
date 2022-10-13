<?php

class Methods {

    // To Make the nootification Message shorter
    public function displayNotify($notify){
        $separator = explode(' ', $notify);

        $string = "...".$separator[0]." ".$separator[1];

        return $string;
    }

    // To make sure it's rigth number
    public function numFilter($field){
        $field = filter_var($field, FILTER_SANITIZE_NUMBER_INT);

        if(preg_match("/^[0][5]{1}[0-9]{8}$/", $field)){
            return $field;
        }else {
            return false;
        }
    }

    // To make sure it's aside with the username standard
    public function usernameFilter($field){
        $field = filter_var(trim($field), FILTER_SANITIZE_STRING);

        if(preg_match("/^[A-Za-z][A-Za-z0-9_]{7,29}$/", $field)){
            return $field;
        }else {
            return false;

        }
    }


    // To make sure it's aside with the password standard
    public function passwordFilter($filed){
        $filed = filter_var(trim($filed), FILTER_SANITIZE_STRING);

        if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $filed)){
            return $filed;
        }else {
            return false;
        }
    }

    // To make sure it's aside Nat.ID standard
    public function filterNatID($field){
        $field = filter_var($field, FILTER_SANITIZE_NUMBER_INT);

        if(preg_match("/^[0-9]{10}$/", $field) == 1){
            return $field;
        }else {
            return false;
        }
    }

}