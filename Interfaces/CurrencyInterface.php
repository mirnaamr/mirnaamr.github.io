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

//Interface for the currency class
interface CurrencyInterface {
    
    //Method used to get currency details
    public function GetCurrencyDetails($currency);
}
