<?php

/**
 * A product item decoder decodes a line of input into usable data
 *
 * @author Francesco David Nota
 */

namespace basket;

include_once(dirname(__FILE__) . '/../products/ProductType.php');

use products\ProductType;

class ProductItemDecoder {
    
    private $quantity;
    private $isImported;
    private $name;
    private $productType;
    private $unitPrice;
    
    /*
     * decodes a line of input into usable data stored in the ProductItemDecoder object
     * @param string $line the line to be decoded into usable data
     */
    public function decode($line){
        $itemChuncks = explode(" ",$line);

        $this->quantity = intval($itemChuncks[0]);

        $priceIndex = count($itemChuncks) - 1;
        $this->unitPrice = floatval($itemChuncks[$priceIndex]);

        $this->isImported = in_array("imported",$itemChuncks);

        $nameChunks = array_slice($itemChuncks,1,$priceIndex - 2);

        if($this->isImported){
            $nameChunks = array_diff($nameChunks, array("imported"));
        }

        $this->name = implode(" ", $nameChunks);
        
        $this->productType = ProductType::getProductTypeHavingName($this->name);
    }
    
    /*
     * checks if the decoded line contained an imported product
     * @return bool true if the decoded product line contained an imported product, false otherwise
     */
    public function isImported(){
        return $this->isImported === true;
    }
    
    /*
     * GETTERS, There are no setters because the values are set by design in the decode function
     * @see ProductItemDecoder::decode()
     */
    
    
    public function getQuantity(){
        return $this->quantity;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getProductType(){
        return $this->productType;
    }
    
    public function getUnitPrice(){
        return $this->unitPrice;
    }
}
