<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->




 <?php 
 #region include classes and create objects needed 
 
 //Include classes needed 
require "Classes\CurrencyClass.php";
require "Classes\CartClass.php";

//Create object from classes
$currencyObj=new CurrencyClass();
$cart = new CartClass();        

//Call create cart method to get product catalog for display
 $productsCatolg =$cart->CreateProductCatalogArray();
 
#endregion
?>
    
<!--Display the values of the cart from the array using table-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body> 
        
        <div><h1><u>Product Catalog</u></h1></div>  
        <table border="1">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price in USD</th>
                </tr>
            </thead>
            <tbody>
                 <?php 
                 foreach($productsCatolg as $prod => $prod_value) {?>
                <tr>
                    <td><?php echo $prod; ?></td>
                    <td><?php echo $prod_value; ?></td>
                </tr>
                  <?php
	}

?>
            </tbody>
        </table>    
        
        <div>Enter your currency and press enter and then enter the items needed in the cart seperated by whitespace after the create cart message is displayed</div>
      <ul>
            <li>
                Please make sure to enter the values as displayed in the product catalog
            </li>
              <li>
                Currencies available for payment are EGP, USD and Euro
            </li>
        </ul>
        <br/>
        
              <?php 
              

     

//Read cart input from the user currency then press enter then enter products seperated by whitespace 
echo 'createCart --bill-currency=';
   $currency = readline('Enter currency');
   $products =readline('Enter products '); 

   

// Output the currency and  items in the cart that matches product catalog after removing the items that don't exist in the catalog
echo '<br>Your currency for payment is ' .$currency .' and products added in your cart that matches the product catalog are : '.$cart->GetCartProducts($products, $productsCatolg);

//Get currency details 
$currencyDetails=$currencyObj->GetCurrencyDetails($currency);

//Calculate cart and display the bill 
$cart->CalculateCart($products, $productsCatolg,$currencyDetails);


?> 
    </body>
</html>