<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //



    protected $table='products';


    public function get_currencie(){
        return $this->belongsTo('App\currencie','currencie_id','id');
    }

    public function get_Offer(){
        return $this->belongsTo('App\Offer','id','products_id');
    }


}
