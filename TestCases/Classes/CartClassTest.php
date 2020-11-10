<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CartClassTest
 *
 * @author Lenovo
 */

//Include needed classes 
include  "..\CartClass.php";

//Class for unit test cart class
class CartClassTest extends PHPUnit_Framework_TestCase {

    
    //Object needed 
     protected $cartClass;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

       //Instantiate tested object to use 
        $this->cartClass = new CartClass();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        //unset object
        unset($this->cartClass);
    }

    //Method that tests create cart array 
    //It asserts same if the return of the method is equal to the products catalog array
    public function testCreateCartArray(): void
    {
       
        $expected = array("T-shirt"=>10.99, "Pants"=>14.99, "Jacket"=>19.99, "Shoes"=>24.99);
        $this->assertSame($expected, $this->cartClass->CreateCartArray());
    }

    //Method that test the product in the cart that match the product catalog
    //It asserts true if the return of the method is not equal empty string 
    public function testGetCartProducts($productsAdded, $productsCatalogArray): void
    {
       
        $this->assertTrue($this->cartClass->GetCartProducts($productsAdded, $productsCatalogArray)!='');
       
    }

       //Method that test the price calculation of the products in the cart 
    //It asserts true if the return of the method is greater than 0  
    public function testCalculatePrice($productsAdded, $productsCatalogArray): void
    { 
        $this->assertTrue($this->cartClass->GetCartProducts($productsAdded, $productsCatalogArray)>=0);
    }
    
    
   //Method that test the discount calculation for both shoes and jacket 
    //It asserts true if the return of the method is equal to array that contains both shoesDiscount and jacketDiscounts values 
    public function testCalculateDiscounts($productsAdded, $productsCatalogArray): void
    {
        $expected =   array( 'shoesDiscount', 'jacketDiscount');
        $this->assertTrue($expected,$this->cartClass->CalculateDiscounts($productsAdded, $productsCatalogArray));
    }

     //Method that test the display of the cart bill 
    //It asserts instance of the exception if an exception is thrown 
    public function testDisplayCartBill($price,$taxes,$shoesDiscount,$jacketDiscount,$currencyDetails): void
    {
        $e=null;
        $this->assertInstanceOf(\Exception::class,$e);
    }

     //Method that test the cart calculation 
    //It asserts instance of the exception if an exception is thrown 
    public function testCalculateCart($productsAdded, $productsCatalogArray,$currencyDetails): void
    { 
        $e=null;
        $this->assertInstanceOf(\Exception::class,$e);
    }
    
}
