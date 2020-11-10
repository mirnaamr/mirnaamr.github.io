<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Lenovo
 */

interface CartInterface {
    //Method that create products catalog and return array of products catalog 
     public function CreateProductCatalogArray();
      //Method that takes product added in the cart and producat catalog array and get return products in the cart that matches the product catalog
     public function GetCartProducts ($productsAdded, $productsCatalogArray);
     //Method that takes product added in the cart and producat catalog array and calaculate cart 
     public function CalculateCart($productsAdded, $productsCatalogArray,$currencyDetails);
    
}
