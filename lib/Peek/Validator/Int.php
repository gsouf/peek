<?php

namespace Peek\Validator;

use \Peek\Utils\ValuesUtils;

/**
 * Validator class provides a way to validate values. Use it with the extending classes and in a Validator Collection
 *
 * @author Soufiane Ghzal
 */
class Int {
    
    protected $min; 
    protected $max;
    
    public function __construct() {
        $this->max=null;
        $this->min=null;
    }
    
    public function validate($n){
        
       if(!ValuesUtils::isInt($n))
           return false;
       
       if(null!==$this->max && $n>$this->max)
           return false;
       
       if(null!==$this->min && $n<$this->min)
           return false;
       
       return true;
    }
    
    public function min($min) {
        $this->min = $min;
        return $this;
    }

    public function max($max) {
        $this->max = $max;
        return $this;
    }




    
}

?>