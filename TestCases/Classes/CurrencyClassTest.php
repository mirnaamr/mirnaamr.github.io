<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CurrencyClassTest
 *
 * @author Lenovo
 */

//Include needed classes 
include  "..\CurrencyClass.php";
include  "..\CurrencyModel.php";

//Class for unit test currency class
class CurrencyClassTest extends PHPUnit_Framework_TestCase {

    
 
    
//Objects needed     
protected $currencyClass;
protected $currencyModel;

    protected function setUp(): void
    {
        parent::setUp();

        //Instantiate tested objects to use 
        $this->currencyClass = new CurrencyClass();
         $this->$currencyModel = new CurrencyModel();
    }
    
    protected function tearDown(): void
    {
        parent::tearDown();

        //unset objects 
        unset($this->currencyClass);
         unset($this->currencyModel);
    }    
  
    //Method that tests the currency details entered 
     //It asserts true if the return of currency details method in equal to currency model 
    public function testGetCurrencyDetails($currency): void
    {
             
        $expected = $this->currencyModel;
        $this->assertTrue($expected, $this->currencyClass->GetCurrencyDetails($currency));
        
    }
    

    
    //Method that tests the usd currency 
      //It asserts same if the return of currency details method in equal to details of usd currency model
    public function testGetCurrencyDetailsForUSD(): void
    {
      
        
    $this->currencyModel->currencySign='$';
    $this->currencyModel->currencyConvert=1;
    $this->currencyModel->currencySignPosition='left';
        
        $expected = $this->currencyModel;
        $this->assertSame($expected, $this->currencyClass->GetCurrencyDetails('USD'));
        
    }
    
     
        //Method that tests the egp currency 
      //It asserts same if the return of currency details method in equal to details of egp currency model
    public function testGetCurrencyDetailsForEGP(): void
    {
      
    $this->currencyModel->currencySign='e£';
    $this->currencyModel->currencyConvert=15.69;
    $this->currencyModel->currencySignPosition='right';
       
        $expected = $this->currencyModel;
        $this->assertSame($expected, $this->currencyClass->GetCurrencyDetails('EGP'));
        
    }
    

       //Method that tests the euro currency 
      //It asserts same if the return of currency details method in equal to details of euro currency model
       public function testGetCurrencyDetailsForEuro(): void
    {
      
    $this->currencyModel->currencySign='€';
    $this->currencyModel->currencyConvert=1.19;
    $this->currencyModel->currencySignPosition='left';
       
        $expected = $this->currencyModel;
        $this->assertSame($expected, $this->currencyClass->GetCurrencyDetails('EURO'));
        
       
        
    }
    
       //Method that tests any other currencies not defined in currency class 
      //It asserts same if the return of currency details method is equal to default object 
      public function testGetCurrencyDetailsForOtherCurrencies(): void
    {
      
    $this->currencyModel->currencySign='';
    $this->currencyModel->currencyConvert=1;
    $this->currencyModel->currencySignPosition='';
       
        $expected = $this->currencyModel;
        $this->assertSame($expected, $this->currencyClass->GetCurrencyDetails('sterling'));
        
       
        
    }
    
}
