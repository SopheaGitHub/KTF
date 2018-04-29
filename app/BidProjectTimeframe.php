<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidProjectTimeframe extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'bid_project_timeframe';
    protected $fillable = [
        'duration', 'timeframe_id','bid_project_id'
    ];
}
