<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CurrencyClass
 *
 * @author Lenovo
 */

//Include all needed models and interfaces 
include  "Interfaces\CurrencyInterface.php";
include "Models\CurrencyModel.php";

//Currency class that implements method in currency interface 
class CurrencyClass implements CurrencyInterface{

// Get currency details method that takes currency as input and switch on 3 currrencies usd, egp and euro 
// and set the details for each currency using object from currency model and return this object 
//If currency doesn't exit then error message that this currency is invalid will be displayed and the program will exit
    
    function  GetCurrencyDetails($currency)
    {
    
        try
        {
 
 //create object from the currency model           
 $currencyObj= new CurrencyModel();
 
    //Check for the currency  
   //check if currency is valid , if not program shall exit
 
 //switch on the currency paramenter after convertting it to upper case 
switch (trim(strtoupper($currency))) {  
   
 //dollar case, return currency model object with dollar information    
  case "USD":
   $currencyObj->currencySign='$';
   $currencyObj->currencyConvert=1;
   $currencyObj->currencySignPosition='left';
   return $currencyObj;
   
   //egp case,  return currency model object with egp information 
  case "EGP":
   $currencyObj->currencySign='e£';
   $currencyObj->currencyConvert=15.69;
   $currencyObj->currencySignPosition='right';
  return $currencyObj;
  
  //euro case,  return currency model object with euro information 
  case "EURO":
   $currencyObj->currencySign='€';
   $currencyObj->currencyConvert=1.19;
   $currencyObj->currencySignPosition='left';
    return $currencyObj;
    
    //default case, return error message iif currency doesn't exist in the above and the program is exited 
  default: 
      echo 'This currency is not valid, currencies available are : USD, EGP and Euro <br>';
      exit('Please run program again and choose a valid currency');
    
}
        }

//Throw exception, if exists         
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
}
    }

