<?php

include_once(dirname(__FILE__) . '/../../basket/ProductItem.php');
include_once(dirname(__FILE__) . '/../../products/Product.php');
include_once(dirname(__FILE__) . '/../../products/ProductType.php');

use basket\ProductItem;
use products\Product;
use products\ProductType;

class ProductItemTest extends PHPUnit_Framework_TestCase{
    private $productItem;
    
    public function testAddProduct(){
        $this->productItem = new ProductItem();
        
        $previousProductItemSize = count($this->productItem->getProductList());
        $this->productItem->addProduct(new Product("chocolate",ProductType::FOOD,11.99));
        
        $newProductItemSize = count($this->productItem->getProductList());
        $this->assertEquals($previousProductItemSize + 1, $newProductItemSize);
    }
    
    public function testGetTotalPrice(){
        $this->addProductsToProductItem(2,"harry potter", ProductType::BOOK,12.99);
        $actual = $this->productItem->getTotalPrice();
        $expected = 25.98;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(2,"data science", ProductType::BOOK,12.99,true,true);
        $actual = $this->productItem->getTotalPrice();
        $expected = 27.28;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(3,"chocolate", ProductType::FOOD,3.99);
        $actual = $this->productItem->getTotalPrice();
        $expected = 11.97;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(3,"pasta", ProductType::FOOD,3.99,true,true);
        $actual = $this->productItem->getTotalPrice();
        $expected = 12.57;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(1,"headache pills", ProductType::FOOD,22.00);
        $actual = $this->productItem->getTotalPrice();
        $expected = 22.00;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(4,"patch", ProductType::FOOD,2.42,true,true);
        $actual = $this->productItem->getTotalPrice();
        $expected = 10.28;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(1,"cluedo", ProductType::GAME,11.27,false);
        $actual = $this->productItem->getTotalPrice();
        $expected = 12.42;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(3,"porfume", ProductType::GENERIC,40.76,false,true);
        $actual = $this->productItem->getTotalPrice();
        $expected = 140.73;
        $this->assertEquals($expected, $actual);
    }
    
    public function testGetTotalTaxes(){
        $this->addProductsToProductItem(2,"harry potter", ProductType::BOOK,12.99);
        $actual = $this->productItem->getTotalTaxes();
        $expected = 0;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(2,"data science", ProductType::BOOK,12.99,true,true);
        $actual = $this->productItem->getTotalTaxes();
        $expected = 1.3;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(3,"chocolate", ProductType::FOOD,3.99);
        $actual = $this->productItem->getTotalTaxes();
        $expected = 0;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(3,"pasta", ProductType::FOOD,3.99,true,true);
        $actual = $this->productItem->getTotalTaxes();
        $expected = 0.6;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(1,"headache pills", ProductType::FOOD,22.00);
        $actual = $this->productItem->getTotalTaxes();
        $expected = 0;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(4,"patch", ProductType::FOOD,2.42,true,true);
        $actual = $this->productItem->getTotalTaxes();
        $expected = 0.6;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(1,"cluedo", ProductType::GAME,11.27,false);
        $actual = $this->productItem->getTotalTaxes();
        $expected = 1.15;
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(3,"porfume", ProductType::GENERIC,40.76,false,true);
        $actual = $this->productItem->getTotalTaxes();
        $expected = 18.45;
        $this->assertEquals($expected, $actual);
    }
    
    
    public function testGetStringDescription(){
        $this->addProductsToProductItem(2,"harry potter", ProductType::BOOK,12.99);
        $actual = $this->productItem->getStringDescription();
        $expected = "2 harry potter: 25.98";
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(3,"pasta", ProductType::FOOD,3.99,true,true);
        $actual = $this->productItem->getStringDescription();
        $expected = "3 imported pasta: 12.57";
        $this->assertEquals($expected, $actual);
        
        $this->addProductsToProductItem(1,"cluedo", ProductType::GAME,11.27,false);
        $actual = $this->productItem->getStringDescription();
        $expected = "1 cluedo: 12.42";
        $this->assertEquals($expected, $actual);
    }
    
    private function addProductsToProductItem($quantity,$name,$type,$price,$exemptFromTaxes = true,$isImported = false){
        $this->productItem = new ProductItem();
        
        for($i = 0; $i < $quantity;$i++){
            $p = new Product($name,$type,$price,$isImported);
            
            if($exemptFromTaxes){
                $p->setSalesTaxToZero();
            }
            else{
                $p->setSalesTaxToDefaultValue();
            }
            
            $this->productItem->addProduct($p);
        }
    }
}