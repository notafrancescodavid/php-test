<?php

/**
 * A class describing a Shopping basket, each basket contains several product items
 *
 * @author Francesco David Nota
 */

namespace basket;

include_once(dirname(__FILE__) . "/../common/Utils.php");
include_once(dirname(__FILE__) . "/../products/ProductType.php");
include_once(dirname(__FILE__) . "/../products/Product.php");
include_once(dirname(__FILE__) . "/ProductItem.php");

use common\Utils;
use products\ProductType;
use basket\ProductItem;
use products\Product;

class ShoppingBasket {
    
    /*
     * a product item list is a list of ProductItems. Each product item is formed by more products of the same type
     */
    private $productItemList;
    
    public function __construct() {
        //initializing the product list as an empty array
        $this->productItemList = array();
    }
    
    /*
     * Adds a product to the product list
     * @param int $quantity the quantity of the same product in the basket
     * @param string $name the name of the product
     * @param string $type the product type
     * @param double $unitPrice the unit price of the product
     * @param bool $isImported a flag indicating whether the product is imported or not
     */
    public function addProductItem($quantity,$name,$type,$unitPrice,$isImported){
        if(ProductType::productTypeExists($type)){
            //create product item and add products to it
            $productItem = new ProductItem();
            
            for($i = 0; $i < $quantity;$i++){
                $p = new Product($name,$type,$unitPrice,$isImported);
                
                if($this->productIsExemptFromBasicSalesTax($type)){
                    $p->setSalesTaxToZero();   
                }
                else{
                    $p->setSalesTaxToDefaultValue();
                }
                
                $productItem->addProduct($p);
            }
            
            array_push($this->productItemList, $productItem);
        }
        else{
            throw new \Exception("Product type does not exist");
        }
    }
    
    /*
     * checks if a product is exempt from the basic sales tax based on its type
     * @param string $productType the type of the product
     * @return bool true if the product is exempt from the basic sales tax, false otherwise
     */
    private function productIsExemptFromBasicSalesTax($productType){
        return $productType === ProductType::BOOK || $productType === ProductType::FOOD || $productType === ProductType::MEDICAL;
    }
    
    /*
     * @return string a text string representing the receipt
     */
    public function getReceipt(){
        if(count($this->productItemList) > 0){
            $itemsString = $this->getItemsAsString();
            $totalTaxes = Utils::getNumberShowingTwoDecimals($this->calculateTotalTaxesOfItems());
            $totalPrice = Utils::getNumberShowingTwoDecimals($this->calculateTotalPriceOfItems());

            return "{$itemsString}"
                 . "Sales Taxes: {$totalTaxes}\r\n"
                 . "Total: {$totalPrice}\r\n";
        }
        else{
            throw new Exception("The product list is empty, fill the shopping basket before asking for a receipt");
        }
    }
    
    /*
     * @return string a text formed by all the items descriptions
     */
    private function getItemsAsString(){
        $itemsAsString = "";
        foreach($this->productItemList as $productItem){
            $itemsAsString .= "{$productItem->getStringDescription()}\r\n";
        }
        
        return $itemsAsString;
    }
    
    /*
     * @return double the total taxes of all items in the shopping basket
     */
    private function calculateTotalTaxesOfItems(){
        $totalTaxes = 0;
        foreach($this->productItemList as $productItem){
            $totalTaxes += $productItem->getTotalTaxes();
        }
        
        return $totalTaxes;
    }
    
    /*
     * @return double the total price (inclusive of taxes) of all items in the shopping basket
     */
    private function calculateTotalPriceOfItems(){
        $totalPrice = 0;
        foreach($this->productItemList as $productItem){
            $totalPrice += $productItem->getTotalPrice();
        }
        
        return $totalPrice;
    }
    
    /*
     * @return the product item list
     */
    public function getProductItemList(){
        return $this->productItemList;
    }
}
