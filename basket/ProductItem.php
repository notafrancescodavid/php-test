<?php

/**
 * A product item is a list of Products of the same type. It enables the calculation of total price and taxes for the item.
 *
 * @author Francesco David Nota
 */

namespace basket;

include_once(dirname(__FILE__) . "/../common/Utils.php");
include_once(dirname(__FILE__) . "/../products/Product.php");

use common\Utils;
use products\Product;

class ProductItem{
    /*
     * A product list containing all the products associated to the item
     */
    private $productList;
    
    /*
     * The total price of all the products in the item
     */
    private $itemPrice;
    
    /*
     * The total taxes all the products in the item
     */
    private $itemTaxes;
    
    public function __construct() {
        $this->itemPrice = 0;
        $this->itemTaxes = 0;
        $this->productList = array();
    }
    
    /*
     * @param Product $p the product to be added to the product list
     */
    public function addProduct(Product $p){
        array_push($this->productList,$p);
    }
    
    /*
     * @return double the total amount of taxes to be paid for all the products in the product list
     */
    public function getTotalPrice(){
        //reset to 0 the value of itemPrice in case it was already elaborated and in case the number of products was updated
        $this->itemPrice = 0;
        
        foreach($this->productList as $product){
            $this->itemPrice += $product->getTotalPrice();
        }
        
        return $this->itemPrice;
    }
    
    /*
     * @return double the total amount of taxes to be paid for all the products in the product list
     */
    public function getTotalTaxes(){
        //reset to 0 the value of itemTaxes in case it was already elaborated and in case the number of products was updated
        $this->itemTaxes = 0;
        
        foreach($this->productList as $product){
            $this->itemTaxes += $product->getTotalAmountOfTaxes();
        }
        
        return $this->itemTaxes;
    }
    
    /*
     * @return string the description of the item
     */
    public function getStringDescription(){
        $quantity = count($this->productList);
        
        $referenceProduct = $this->productList[0];
        
        $imported = "";
        
        if($referenceProduct->isImported()){
            $imported = " imported";
        }
        
        $name = $referenceProduct->getName();
        $price = Utils::getNumberShowingTwoDecimals($referenceProduct->getTotalPrice() * $quantity);
        
        $description = "{$quantity}{$imported} {$name}: {$price}";
        return $description;
    }
    
    /*
     * @return array the product list of the item
     */
    public function getProductList(){
        return $this->productList;
    }
    
}
