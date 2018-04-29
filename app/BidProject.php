<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidProject extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'bid_project';
    protected $fillable = [
        'desc', 'contact','project_id','user_id','created_at','updated_at',
    ];


}
