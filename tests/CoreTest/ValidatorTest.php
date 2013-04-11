<?php

use Peek\Validator\Int;

class ValidatorTest extends PHPUnit_Framework_TestCase
{

    
    public function testInt()
    {

      $v = Peek\Validator\Validator::int();
      $this->assertEquals(true, $v->validate(5));
      $this->assertEquals(true, $v->validate(-50));
        
    }
    
    
 

}
?>