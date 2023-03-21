<?php

namespace App\Services;


class BaseServices 
{
    /**
     * @var Validation
     */
    public $validation;
    function  __construct(){
        $this->validation=\Config\Services::validation();
    }

}
