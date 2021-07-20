<?php

include_once(dirname(__FILE__) . '/../../products/ProductType.php');

use products\ProductType;

class ProductTypeTest extends PHPUnit_Framework_TestCase{
    
    public function testGetProductTypeHavingName() {
        $productType = ProductType::getProductTypeHavingName("harry potter");
        $this->assertEquals(ProductType::BOOK, $productType);
        
        $productType = ProductType::getProductTypeHavingName("rice");
        $this->assertEquals(ProductType::FOOD, $productType);
        
        $productType = ProductType::getProductTypeHavingName("bottle of porfume");
        $this->assertEquals(ProductType::GENERIC, $productType);
        
        $productType = ProductType::getProductTypeHavingName("fifa");
        $this->assertEquals(ProductType::GAME, $productType);
    }
    
    public function testProductTypeExists(){
        $actual = ProductType::productTypeExists(ProductType::GAME);
        $this->assertEquals(true, $actual);
        
        $actual = ProductType::productTypeExists("sea");
        $this->assertEquals(false, $actual);
        
        $actual = ProductType::productTypeExists(ProductType::FOOD);
        $this->assertEquals(true, $actual);
        
        $actual = ProductType::productTypeExists("bookboook");
        $this->assertEquals(false, $actual);
    }
}