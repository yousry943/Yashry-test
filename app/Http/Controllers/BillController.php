<?php

namespace App\Http\Controllers;

use App\Bill;

use Illuminate\Http\Request;

class BillController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetBillByUsd()
    {
        //
      $cart = app('App\Http\Controllers\CartController')->index();
      $count_cart = count($cart);
      // dd($cart);
       $totleBefore = 0;
       $totalAftter = 0;
      for ($i=0; $i < $count_cart ; $i++) {
// dd($cart[$i]);
           $totleBefore +=  $cart[$i]['price'] ;
           if (  $cart[$i]['offer'] == true ) {
             // code...
          $classname =  config('offer.classname.'.$cart[$i]['name']);
          // dd($classname);

             $shoes = new $classname($cart);

         $couponGenerator = new DiscountGenerator($shoes);
         $totalAftter += $couponGenerator->getDiscount();
          echo $couponGenerator->getDiscount()."<br>";
         // echo "<br>";
       }

      }
      echo "<br>";
      echo "Subtotal:$  ". $totleBefore;
      echo "<br>";
     echo "Taxes: ". $Taxes =  (14 / 100) * $totleBefore;
     echo "<br>";
      echo "Total: ". ((int)$totleBefore + (int)$Taxes -(int)$totalAftter) ;



    }

    public function GetBillByEgp()
    {
       $cart = app('App\Http\Controllers\CartController')->index();
       $count_cart = count($cart);
       //dd($cart);
       $Total= 0;
       for ($i=0; $i < $count_cart ; $i++) {
         if (  $cart[$i]['offer'] == false ) {
           $Total+=$cart[$i]['price'] ;
         }
       }
       return 'Total: egp'. $Total;

    }

}
