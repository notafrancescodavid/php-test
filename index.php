<?php

/**
 * @author Francesco David Nota
 */

include_once(dirname(__FILE__) . "/basket/ProductItemDecoder.php");
include_once(dirname(__FILE__) . "/basket/ShoppingBasket.php");

use basket\ShoppingBasket;
use basket\ProductItemDecoder;

/*
 * ATTENTION:  Change $fileName to test different inputs! If necessary change also the filePath to an absolute one
 */
$filePath = dirname(__FILE__) . "/input";
$fileName = "input1.txt";

//opening the file
$f = fopen("{$filePath}/{$fileName}", "r");

//instantiating the line decoder and the shopping basket
$productItemDecoder = new ProductItemDecoder();
$basket = new ShoppingBasket();

// read the file line by line till the end
while(!feof($f))  {
    //read a line
    $line = fgets($f);
    
    //decode the line into the $productItemDecoder object and get the resulting data
    $productItemDecoder->decode($line);
    $quantity = $productItemDecoder->getQuantity();
    $name = $productItemDecoder->getName();
    $type = $productItemDecoder->getProductType();
    $unitPrice = $productItemDecoder->getUnitPrice();
    $isImported = $productItemDecoder->isImported();
    
    //add the product item to the ShoppingBasket by sending the values obtained from the line decoded by $productItemDecoder 
    $basket->addProductItem($quantity,$name,$type,$unitPrice,$isImported);
}

//close the file
fclose($f);

// get and print the receipt
echo $basket->getReceipt();