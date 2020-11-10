<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CartClass
 *
 * @author Lenovo
 */

//Include all needed interfaces 
include  "Interfaces\CartInterface.php";

//Cart class that implements methods in cart interface as well as another methods 
class CartClass implements CartInterface {
   
    //Method that create products catalog and return array of products catalog 
     function CreateProductCatalogArray() {
         //Creeat key value array for the products catalog 
         //Name of the product is the key and price is the value 
        $productsCatolg = array("T-shirt"=>10.99, "Pants"=>14.99, "Jacket"=>19.99, "Shoes"=>24.99);  
		return $productsCatolg;
	}
        
       //Method that takes product added in the cart and products catalog array and return products in the cart that matches the product catalog  
      function GetCartProducts ($productsAdded, $productsCatalogArray)
      {
           $productInCatalog='';
           try {
       
           //Splits products added by whitespace
           $splittedProducts = preg_split('/ +/', $productsAdded);
          $foundProd=0;
           
           //Loop over the splitted values
              foreach ($splittedProducts as $val )
      {
             
      //Set the first letter in the product to capital letter in order to match the product catalog             
      $firstLetterCapitalValue=ucfirst($val);
       
      //Check if the product key exists in the products catalog 
       if ( array_key_exists($firstLetterCapitalValue, $productsCatalogArray))
       {
           //Increment the products found 
          $foundProd++;
   
          //Concetenate the products found that matches the product catalog and seperate them with comma 
          $productInCatalog=$productInCatalog. ' , '.$firstLetterCapitalValue;
       }
       
      }
      //If no product is found that matches the products catalog, display an error message 
       if ($foundProd==0)
      {
          $productInCatalog ='No products found that match the product catalog';
      }
      
 //Trim the products found string in order to remove any extra commas      
 else {
    $productInCatalog=ltrim($productInCatalog, ' , ');
     $productInCatalog=rtrim($productInCatalog, ' , ');
      
      }
       } catch (Exception $ex) {
            echo 'Message: ' .$e->getMessage();   
           }
           
      return $productInCatalog;
      }
      
      //Method that takes product added in the cart and products catalog array and calculate the price  
        function CalculatePrice ($productsAdded, $productsCatalogArray)
        {
            $price =0.0;
            try
            {
                 //Splits products added by whitespace
             $splittedProducts = preg_split('/ +/', $productsAdded);
              //Loop over the splitted values
     foreach ($splittedProducts as $val )
      {
       //Set the first letter in the product to capital letter in order to match the product catalog   
      $firstLetterCapitalValue=ucfirst($val);
      //Check if the product key exists in the products catalog 
       if ( array_key_exists($firstLetterCapitalValue, $productsCatalogArray))
       {
         //Get sum of the prices of all products 
        $price+=$productsCatalogArray[$firstLetterCapitalValue];
       }
       
       
      }
     
            }
             catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
             }
           return $price;
        }
        
  //Method that takes product added in the cart and products catalog array and calculate both jackets and shoes discount 
        function CalculateDiscounts($productsAdded, $productsCatalogArray)
        {
       $shoesDiscount=0.0;
      $jacketDiscount=0.0;
      try
      {
            
       $shoesCounter=0;
      $shirtCounter=0;
      $jacketCounter=0;
      
        //Splits products added by whitespace
       $splittedProducts = preg_split('/ +/', $productsAdded);
          //Loop over the splitted values
      foreach ($splittedProducts as $val )
      {
           //Set the first letter in the product to capital letter in order to match the product catalog   
      $firstLetterCapitalValue=ucfirst($val);
        //Check if the product key exists in the products catalog 
       if ( array_key_exists($firstLetterCapitalValue, $productsCatalogArray))
       {
          
//Switch on the items and chech whether it's shoes or t-shirt or jacket and increment it's counter            
switch ($firstLetterCapitalValue) {
  case "Shoes":
  $shoesCounter++;
    break;
  case "T-shirt":
     $shirtCounter++;
    break;
  case "Jacket":
    $jacketCounter++;
    break;
 
}
         
       }
      }

      //Check if shoes found 
      if ($shoesCounter!=0 )
      {
          //Multiply number of shoes found by it's price and it's discount (0.1)
          $shoesDiscount =(0.1*$shoesCounter*$productsCatalogArray["Shoes"]);
      }
      //Check if t-shirt found 
      if ($shirtCounter >0)
      {
        //Count the number of t-shirt pairs found by dividing the number of t-shirts found by 2 and take the integer number   
        $numberOfShirtPairs= (int)($shirtCounter/2) ;
        
        //Check if number of t-shirt pairs greater than 0 
        if ($numberOfShirtPairs>0 )
        {
            //Calculate the jackets discounts based on the number of t-shirt pairs and the number of jackets found       
            //Check if the number of jackets less than the number of t-shirts pairs 
            if ($jacketCounter <= $numberOfShirtPairs)
            {
                //Multiply the jacket counter by the price of the jacket multiplied by the jacket counter multiplied by the jacket discount 
                $jacketDiscount=($jacketCounter*0.5*$productsCatalogArray["Jacket"]);
            }
            else
            {
                //Otherwise, we have to get the difference between the jacket counter and number of t-shirt pairs and subtract it from the jacket counter 
                //then multiply the result by the jacket discount (0.5)
              $jacketDiscount= (($jacketCounter - ($jacketCounter-$numberOfShirtPairs))*0.5);
            }
                
        }
      }
              }
             catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
             }
             
         //Return the result as array containing 2 keys and values one foe the soes discount and the other for the jacket discount    
             return array(
        'shoesDiscount' => $shoesDiscount,
        'jacketDiscount' => $jacketDiscount
    );
        }
        
        //Method that takes price, taxes , shoes discount, jacket discount and currency details as parameters and display the cart bill
        function DisplayCartBill($price,$taxes,$shoesDiscount,$jacketDiscount,$currencyDetails)
        {
         try 
         {
                
echo '<br>';

//Check if the currency is not usd where currency convert value will not be equal 1 
if ($currencyDetails->currencyConvert >=1)
{
    //Calculate the price multiplied by the currency convert and round to 3 decimal points
    $price = round(($price*$currencyDetails->currencyConvert),3);
}
else
{
    //In case currency is usd then price will be the same and round to 3 decimal points
   $price = round($price,3);   
}


//Check if the currency sign will be left 
if ($currencyDetails->currencySignPosition =='left')
{
  
    //Display the price and taxes with currency sign to the left 
    echo 'Subtotal: '.$currencyDetails->currencySign.$price.'<br>';
    echo 'Taxes: '.$currencyDetails->currencySign.$taxes.'<br>';
}  
else 
{
     //Display the price and taxes with currency sign to the right 
     echo 'Subtotal: '.$price.' '.$currencyDetails->currencySign.'<br>';
     echo 'Taxes: '.$taxes.' '.$currencyDetails->currencySign.'<br>';
}


           
//Check if discount exist 
if ($shoesDiscount >0 || $jacketDiscount>0  )
{
    
echo 'Discounts: <br>';

//Check if shoes disount exists 
if ($shoesDiscount !=0.0)
{
    
if ($currencyDetails->currencySignPosition =='left')
{
    //Display the discount after round to 3 decimal points with currency sign to the left 
    echo '10% off shoes: -'.$currencyDetails->currencySign.round($shoesDiscount,3).'<br>';
}   
 else
 {
     //Display the discount after round to 3 decimal points with currency sign to the right 
       echo '10% off shoes: -'.round($shoesDiscount,3).' '.$currencyDetails->currencySign.'<br>';
 }
}

//Check if jacket disount exists 
if ($jacketDiscount !=0.0)
{

 //Display the discount after round to 3 decimal points with currency sign to the left 
if ($currencyDetails->currencySignPosition =='left')
{
    echo '50% off jacket: -'.$currencyDetails->currencySign.round($jacketDiscount,3).'<br>';
}   
 else
 {
      //Display the discount after round to 3 decimal points with currency sign to the left 
       echo '50% off jacket: -'.round($jacketDiscount,3).' '.$currencyDetails->currencySign.'<br>';
 }

}
     
}
if ($currencyDetails->currencySignPosition =='left')
{
 //Calculate the total by adding the taxes, prices and subtracting the shoes and jacket discount 
 //Display the total  after round to 3 decimal points with currency sign to the left 
echo 'Total: '.$currencyDetails->currencySign.round((($price+$taxes)-$shoesDiscount-$jacketDiscount),3);
}
else
{
     //Calculate the total by adding the taxes, prices and subtracting the shoes and jacket discount 
 //Display the total  after round to 3 decimal points with currency sign to the righr  
    echo 'Total: '.round((($price+$taxes)-$shoesDiscount-$jacketDiscount),3).' '.$currencyDetails->currencySign;
}
             
         }
         catch (Exception $e)
         {
               echo 'Message: ' .$e->getMessage();
         }
        }
        
          //Method that takes product added in the cart and product catalog array and calculate cart 
        function CalculateCart($productsAdded, $productsCatalogArray,$currencyDetails)
        {
          try
          {
    
 //Call the calculate price method to calculate the price 
 $price =$this->CalculatePrice ($productsAdded, $productsCatalogArray);
  
//Call the calculate discount method to calculate both shoes and jacket discount 
 $discounts=$this->CalculateDiscounts ($productsAdded, $productsCatalogArray);       
 
 //Get the shoes discount from calculate discount method calling 
 $shoesDiscount=$discounts['shoesDiscount'];
  //Get the jacket discount from calculate discount method calling 
 $jacketDiscount=$discounts['jacketDiscount'];
 
//Calculate the taxes by multiplying the price by 0.14 and round to 2 decimal points  
 $taxes=round(($price*0.14),2);
 
 //Call display cart bill for the bill printing 
  $this->DisplayCartBill($price,$taxes,$shoesDiscount,$jacketDiscount,$currencyDetails);
   
          }
          catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
        }
        
}
