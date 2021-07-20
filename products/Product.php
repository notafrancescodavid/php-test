<?php

/**
 * A class describing a product
 *
 * @author Francesco David Nota
 */

namespace products;

include_once(dirname(__FILE__) . "/../common/Utils.php");

use common\Utils;

class Product {
    /*
     * the tax rate of imported products
     */
    const IMPORT_TAX_RATE = 0.05;
    
    /*
     * the default sales tax rate on a product
     */
    const DEFAULT_SALES_TAX = 0.1;
    
    /*
     * the name of the product
     */
    private $name;
    
    /*
     * the unit price of the product
     */
    private $unitPrice;
    
    /*
     * the tax rate to be applied on the product
     */
    private $salesTax;
    
    /*
     * A variable describing whether the product is imported or not. If the product is imported the value is set to true
     */
    private $isImported;
    
    /*
     * a variable describing the type of the product
     */
    private $productType;
    
    /*
     * By default the sales tax is 10 for all products
     * @param string $name the name of the product
     * @param string $productType the product type
     * @param double $unitPrice the unit price of the product
     * @param bool $isImported a boolean value that states whether a product is imported or not
     */
    public function __construct($name,$productType,$unitPrice,$isImported = false) {
        // by default the product is considered not imported
        $this->name = $name;
        $this->unitPrice = $unitPrice;
        $this->productType = $productType;
        $this->isImported = $isImported;
    }
    
    /*
     * checks if the product is imported
     * @final
     * @return true if the product is imported, false otherwise.
     */
    public final function isImported(){
        return $this->isImported === true;
    }
    
    /*
     * @return double the amount of total sales and import taxes calculated on the product
     */
    public function getTotalAmountOfTaxes(){
        if($this->isImported()){
            $taxes = $this->unitPrice * ($this->salesTax + Product::IMPORT_TAX_RATE);
        }
        else{
            $taxes = $this->unitPrice * $this->salesTax;
        }
        
        return Utils::roundUp($taxes);
    }
    
    public function getTotalPrice(){
        return $this->getUnitPrice() + $this->getTotalAmountOfTaxes();
    }
    
    /*
     * GETTERS AND SETTERS
     */
    
    /*
     * sets the name of the product
     * @param string $name the new name of the product
     */
    public final function setName($name){
        $this->name = $name;
    }
    
    
    /*
     * @return string the name of the product
     */
    public final function getName(){
        return $this->name;
    }
    
    /*
     * sets the unit price
     * @param double $unitPrice the new unit price of the product
     */
    public final function setUnitPrice($unitPrice){
        $this->unitPrice = $unitPrice;
    }
    
    /*
     * @return double the unit price
     */
    public final function getUnitPrice(){
        return $this->unitPrice;
    }
    
    
    /*
     * Sets the sales tax rate. The percentage must be represented in decimal.
     * @param double $salesTax the sales tax rate
     */
    public function setSalesTax($salesTax){
        $this->salesTax = $salesTax;
    }
    
    /*
     * Sets the sales tax to the default rate. The default percentage is represented in decimal.
     * @see Product::DEFAULT_SALES_TAX
     */
    public function setSalesTaxToDefaultValue(){
        $this->salesTax = Product::DEFAULT_SALES_TAX;
    }
    
    /*
     * Sets the sales tax to zero
     * @final
     */
    public final function setSalesTaxToZero(){
        $this->salesTax = 0;
    }
    
    /*
     * @final
     * @return double the sales tax in decimal
     */
    public final function getSalesTaxInDecimal(){
        return $this->salesTax;
    }
    
    /*
     * @final
     * @return int the sales tax
     */
    public final function getSalesTax(){
        return $this->salesTax * 100;
    }
    
    /*
     * sets the product as imported
     * @final
     */
    public final function setProductAsImported(){
        $this->isImported = true;
    }
    
    /*
     * sets the product as not imported
     * @final
     */
    public final function setProductAsNotImported(){
        $this->isImported = false;
    }
}
