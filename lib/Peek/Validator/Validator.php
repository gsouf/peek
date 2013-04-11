<?php

namespace Peek\Validator;

/**
 * Validator class provides a way to validate values. Use it with the extending classes and in a Validator Collection
 *
 * @author Soufiane Ghzal
 */
abstract class Validator {
    
    /**
     * @return boolean
     */
    public abstract function validate($value);
    
    /**
     * make a new Int validator instance
     * @return \Peek\Validator\Int
     */
    public static function int(){
        return new Int();
    }
    
}

?>
