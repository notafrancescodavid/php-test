<?php

include_once(dirname(__FILE__) . '/../../basket/ProductItemDecoder.php');

use basket\ProductItemDecoder;

class ProductItemDecoderTest  extends PHPUnit_Framework_TestCase{
    private $productItemDecoder;
    
    public function testDecode(){
        $this->productItemDecoder = new ProductItemDecoder();
        
        $line1 = "3 box of imported chocolates at 35.55";
        $this->productItemDecoder->decode($line1);
        $this->assertEquals(3,$this->productItemDecoder->getQuantity());
        $this->assertEquals(true,$this->productItemDecoder->isImported());
        $this->assertEquals("box of chocolates",$this->productItemDecoder->getName());
        $this->assertEquals(35.55,$this->productItemDecoder->getUnitPrice());
        
        $line2 = "1 packet of headache pills at 9.75";
        $this->productItemDecoder->decode($line2);
        $this->assertEquals(1,$this->productItemDecoder->getQuantity());
        $this->assertEquals(false,$this->productItemDecoder->isImported());
        $this->assertEquals("packet of headache pills",$this->productItemDecoder->getName());
        $this->assertEquals(9.75,$this->productItemDecoder->getUnitPrice());
        
        $line3 = "2 imported bottle of perfume at 54.65";
        $this->productItemDecoder->decode($line3);
        $this->assertEquals(2,$this->productItemDecoder->getQuantity());
        $this->assertEquals(true,$this->productItemDecoder->isImported());
        $this->assertEquals("bottle of perfume",$this->productItemDecoder->getName());
        $this->assertEquals(54.65,$this->productItemDecoder->getUnitPrice());
    }
}
