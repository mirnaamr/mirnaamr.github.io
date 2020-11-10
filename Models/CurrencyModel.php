<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CurrencyModel
 *
 * @author Lenovo
 */

//Model for the currency class 
class CurrencyModel {

//Used to set the sign displayed for the currency    
public $currencySign;

//Value that shall be multiplied by dollar price to convert to the used currency, since the price used in product catalog is dollar 
public $currencyConvert;

//Used to determine whether to add the sign to the left of the price or to the right 
public $currencySignPosition;

//Default constructor that sets default values for the currency model properties
function __construct( ) {
		$this->currencySign = '';
		$this->currencyConvert = 0;
                $this->currencySignPosition='';
	}
    
}
