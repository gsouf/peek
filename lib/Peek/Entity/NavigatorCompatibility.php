<?php

/**
 * Replacement for Navigator trait to be compatible with php 5.3
 * @copyright (c) Rock A Gogo VPC
 */

namespace Peek\Entity;

/**
 * NavigatorCompatibility
 *
 * @author sghzal
 */
class NavigatorCompatibility {
    
    public static $___navigatorTrait_generated_default_class = array();
    
    public function defaultNavigatorExcludeProperty(){
        return array();
    }
    
    public function getDefaultEntityNavigator(){
        $class = get_class($this);
        
        if(!isset(self::$___navigatorTrait_generated_default_class[$class])){
            $reflect = new \ReflectionObject($this);
            $properties = $reflect->getProperties();
            $excluded = $this -> defaultNavigatorExcludeProperty();
            $excluded[]="___navigatorTrait_generated_default_class";
            $tmp = array();
            foreach($properties as $prop){
                if( !in_array($prop->getName(), $excluded)  ){
                    $tmp[$prop->getName()]=null;
                }
            } 
            
            self::$___navigatorTrait_generated_default_class[$class]=$tmp;
        }
        
        return self::$___navigatorTrait_generated_default_class[$class];
        
    }
    
}
