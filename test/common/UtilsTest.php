<?php


include_once(dirname(__FILE__) . '/../../common/Utils.php');

use common\Utils;

class UtilsTest  extends PHPUnit_Framework_TestCase{
    
    public function testRoundUp() {
        $actual = Utils::roundUp(0);
        $this->assertEquals(0, $actual);
        
        $actual = Utils::roundUp(4.42);
        $this->assertEquals(4.45, $actual);
        
        $actual = Utils::roundUp(4.95);
        $this->assertEquals(4.95, $actual);
        
        $actual = Utils::roundUp(9.0006);
        $this->assertEquals(9.05, $actual);
        
        $actual = Utils::roundUp(9.11);
        $this->assertEquals(9.15, $actual);
        
        $actual = Utils::roundUp(9.96);
        $this->assertEquals(10, $actual);
        
        $actual = Utils::roundUp(123.48);
        $this->assertEquals(123.5, $actual);
    }
}
