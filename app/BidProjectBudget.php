<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidProjectBudget extends Model
{

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'bid_project_budget';
    protected $fillable = [
        'amount', 'currency_id','bid_project_id'
    ];
}
