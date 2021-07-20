<?php

include_once(dirname(__FILE__) . '/../../products/Product.php');
include_once(dirname(__FILE__) . '/../../products/ProductType.php');

use products\Product;
use products\ProductType;

class ProductTest extends PHPUnit_Framework_TestCase{
    private $product;
    
    public final function testIsImported(){
        $this->product = new Product("harry potter",ProductType::BOOK,11.34,true);
        $this->assertEquals(true,$this->product->isImported());
        
        $this->product = new Product("harry potter",ProductType::BOOK,11.34,false);
        $this->assertEquals(false,$this->product->isImported());
    }
    
    public function testGetTotalAmountOfTaxes(){
        $this->product = new Product("harry potter",ProductType::BOOK,11.34,true);
        $this->product->setSalesTaxToZero();
        $this->assertEquals(0.6,$this->product->getTotalAmountOfTaxes());
        
        $this->product = new Product("rice",ProductType::FOOD,1.44,false);
        $this->product->setSalesTaxToZero();
        $this->assertEquals(0,$this->product->getTotalAmountOfTaxes());
        
        $this->product = new Product("fifa",ProductType::GAME,15.94,true);
        $this->product->setSalesTaxToDefaultValue();
        $this->assertEquals(2.4,$this->product->getTotalAmountOfTaxes());
        
        $this->product = new Product("porfume",ProductType::GENERIC,22.29,false);
        $this->product->setSalesTaxToDefaultValue();
        $this->assertEquals(2.25,$this->product->getTotalAmountOfTaxes());
    }
    
    public function testGetTotalPrice(){
        $this->product = new Product("harry potter",ProductType::BOOK,11.34,true);
        $this->product->setSalesTaxToZero();
        $this->assertEquals(11.94,$this->product->getTotalPrice());
        
        $this->product = new Product("rice",ProductType::FOOD,1.44,false);
        $this->product->setSalesTaxToZero();
        $this->assertEquals(1.44,$this->product->getTotalPrice());
        
        $this->product = new Product("fifa",ProductType::GAME,15.94,true);
        $this->product->setSalesTaxToDefaultValue();
        $this->assertEquals(18.34,$this->product->getTotalPrice());
        
        $this->product = new Product("porfume",ProductType::GENERIC,22.29,false);
        $this->product->setSalesTaxToDefaultValue();
        $this->assertEquals(24.54,$this->product->getTotalPrice());
    }
    
    public function testMainGetAndSetMethods(){
        $this->product = new Product("harry potter",ProductType::BOOK,11.34,true);
        $this->product->setSalesTaxToZero();
        $this->assertEquals(0.00,$this->product->getSalesTaxInDecimal());
        $this->assertEquals(0.00,$this->product->getSalesTax());
        
        $this->product = new Product("rice",ProductType::FOOD,1.44,false);
        $this->product->setSalesTaxToZero();
        $this->assertEquals(1.44,$this->product->getTotalPrice());
        
        $this->product = new Product("fifa",ProductType::GAME,15.94,true);
        $this->product->setSalesTaxToDefaultValue();
        $this->assertEquals(Product::DEFAULT_SALES_TAX,$this->product->getSalesTaxInDecimal());
        $this->assertEquals(Product::DEFAULT_SALES_TAX * 100,$this->product->getSalesTax());
        
        $this->product = new Product("porfume",ProductType::GENERIC,22.29,false);
        $this->product->setSalesTaxToDefaultValue();
        $this->assertEquals(24.54,$this->product->getTotalPrice());
    }
}
