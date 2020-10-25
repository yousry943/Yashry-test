<?php

namespace App\Http\Controllers;

use App\cart;
use App\product;
use Illuminate\Http\Request;

class CartController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {//1 =T-shirt  2=shoes 3= pans 4= jacket
         $product_id = [1,1,2,4];
        // $product_id = [1,3];
      $product_duplicate =   array_count_values($product_id);

        $product = [];

        foreach($product_id as $value)
        {
            $get_product = product::with('get_Offer')->find($value);
             $have_offer = $get_product->get_Offer()->exists();

             if ($have_offer) {
               $x= true;
             }else {
               $x = false;
             }
            $data = array('name' => $get_product->name,"price"=>$get_product->price,"count"=>$product_duplicate[$value],'offer'=>$x);
           array_push($product,$data);

        }
           return $product;


         //dd($product[0]->get_currencie()->first()-name);
         // return $product;

// dd($product);
//         dd( $product  =   [
// array("name"=>"shoes","price"=>"19","count"=>"2"),
// array("name"=>"jacket","price"=>"10","count"=>"1")
// ]);
    }


}
