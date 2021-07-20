<?php


/**
 * A class containing all the constants representing products and product types
 *
 * @author Francesco David Nota
 */

namespace products;

class ProductType {
    const GENERIC = "generic";
    const BOOK = "book";
    const FOOD = "food";
    const MEDICAL = "medical";
    const GAME = "game";
    
    const ALL_TYPES_ARRAY = array(
        ProductType::GENERIC,
        ProductType::BOOK,
        ProductType::FOOD,
        ProductType::MEDICAL,
        ProductType::GAME
    );
    
    const ProductTypeArray = [
        ProductType::GAME => [
            "fifa",
            "cluedo"
        ],
        ProductType::BOOK => [
            "book",
            "harry potter",
            "designing data intensive apps"
        ],
        ProductType::FOOD => [
            "box of chocolate",
            "chocolate bar",
            "rice",
            "pasta"
        ],
        ProductType::MEDICAL => [
            "headache pills",
            "patch"
        ]
    ];
    
    /*
     * identifies and returns the product type having its name
     * @param string $productName the product name used to identify its type
     * @return string the product type
     */
    public static function getProductTypeHavingName($productName){
        $productType = "";
        //reducing to lower to identify all potential name types
        $lowerCaseProductName = strtolower($productName);
        foreach(ProductType::ProductTypeArray as $key => $productTypeList){
            foreach($productTypeList as $productType){
                if(strpos($lowerCaseProductName, $productType) !== false){
                    // the key of the array is the type of the product
                    return $key;
                }
            }
        }
        
        return ProductType::GENERIC;
    }
    
    /*
     * checks if a product type exists
     * @param string $productType the product which existance has to be checked
     * @see ProductType::ALL_TYPES_ARRAY
     */
    public static function productTypeExists($productType){
        if(in_array($productType, ProductType::ALL_TYPES_ARRAY)){
            return true;
        }
        
        return false;
    }
}
