<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Currency extends Model
{


	 protected $table = 'currency';

     public function getCurrency(){
    	$result = DB::table('currency')->get();
		return $result;
    }
}
