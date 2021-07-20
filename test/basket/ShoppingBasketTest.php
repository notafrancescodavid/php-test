<?php

include_once(dirname(__FILE__) . '/../../basket/ShoppingBasket.php');
include_once(dirname(__FILE__) . '/../../products/ProductType.php');

use products\ProductType;
use basket\ShoppingBasket;

class ShoppingBasketTest extends PHPUnit_Framework_TestCase{
    
    private $shoppingBasket;
    
    public function testAddProductItem(){
        $this->shoppingBasket = new ShoppingBasket();
        $previousProductItemListLength = count($this->shoppingBasket->getProductItemList());
        $this->shoppingBasket->addProductItem(2, "harry potter", ProductType::BOOK , 12.45, true);
        $this->shoppingBasket->addProductItem(3, "rice", ProductType::FOOD , 11.90, false);
        $this->shoppingBasket->addProductItem(1, "porfume", ProductType::GENERIC , 41.10, true);
        $currentProductItemListLength = count($this->shoppingBasket->getProductItemList());
        
        $this->assertEquals($previousProductItemListLength + 3, $currentProductItemListLength);
    }
    
    public function testGetReceiptTest(){
        $this->shoppingBasket = new ShoppingBasket();
        $this->shoppingBasket->addProductItem(2, "harry potter", ProductType::BOOK , 12.45, true);
        $this->shoppingBasket->addProductItem(3, "rice", ProductType::FOOD , 11.90, false);
        $this->shoppingBasket->addProductItem(1, "porfume", ProductType::GENERIC , 41.10, true);
        
        $expectedReceipt = "2 imported harry potter: 26.20\r\n"
                . "3 rice: 35.70\r\n"
                . "1 imported porfume: 47.30\r\n"
                . "Sales Taxes: 7.50\r\n"
                . "Total: 109.20\r\n";
        
        $this->assertEquals($expectedReceipt, $this->shoppingBasket->getReceipt());
    }
}
