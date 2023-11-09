<?php

namespace App\Traits;

trait SanitizeInputTrait {

    public function SanitizeInput($input){

        return preg_replace('/[^a-zA-Z0-9]/', '', $input);
        
    }
}