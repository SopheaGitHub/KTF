<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use DB;

class BudgetRange extends Eloquent
    {
     public function getBudgetRangeByCurrencyID($currency_id){
    	$result = DB::table(DB::raw('
				(SELECT
					*
				FROM
					budget_range 
				WHERE  currency_id = "'.$currency_id.'") as br
			'))->get();
		return $result;
    }
}
