<?php
namespace App\Http\Controllers;



class JacketHalfOffer implements InterfaceDiscountGenerator {

  function __construct($product)
  {
    $this->product = $product;
  }

  public  function  discount()
  {

    $data = collect($this->product)->where('name', 'T-shirt')->all();
    $key = array_keys($data);
    if ($data[$key[0]]['count'] == 2 ) {
      $data = collect($this->product)->where('name', 'Jacket')->all();
      $key = array_keys($data);


      $disscount =  $data[$key[0]]['price'] / 2;
return $disscount ;
    }


  }
}
