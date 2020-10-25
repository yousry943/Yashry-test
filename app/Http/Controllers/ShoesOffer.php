<?php
namespace App\Http\Controllers;



class ShoesOffer implements InterfaceDiscountGenerator {

  function __construct($product)
  {
    $this->product = $product;
  }

  public  function  discount()
  {
$data = collect($this->product)->where('name', 'Shoes')->all();
$key = array_keys($data);

    $percentage = 10;

$disscount = ($percentage / 100) * $data[$key[0]]['price'];
         return  $disscount ;
  }
}
