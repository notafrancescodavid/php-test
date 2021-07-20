This repository contains a PHP excercise test.

In order to execute the code it is necessary to run it from the command line.
In particular it is necessary to:

1) clone the repository from github 
2) "cd" in the directory where the repository has been cloned.
3) run "php index.php"

To change the input file it is necessary to change the variable $fileName in the file "index.php".
The $fileName variable can assume 4 values, based on the input files available under the "input" directory.
These values are:
"input1.txt", "input2.txt", "input3.txt", "input4.txt"

It is possible to run the unit tests of all the classes by using phpunit.
Specifically, by presuming that the current directory is the project directory, the tests can be run with the following command:
"phpunit test"

CODE FAST EXPLANATION.

The code is divided into 3 folders: basket, products and common.
 
The common folder has a Utils class with some utility functions.

The products folder has two Classes: 
Product: represents the concept of a product and is responsible to manage its internal state, calculate taxes and the product price.
ProductType: is used as an utility to recognize different types of products and keep track of them.

The basket folder has three classes:
ProductItem: Represents an item in the purchase list. It has multiple equal products and it calculates the total taxes and price of the products in the item.
ShoppingBasket: It is formed by all ProductItems. It calculates the entire taxes and prices of the shopping basket and it prints the receipt
ProductItemDecoder: It decodes a line of string input into data usable to instantiate a Product Item