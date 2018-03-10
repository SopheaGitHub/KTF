<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostProject extends Model
{
   
    protected $primaryKey = 'id';
    protected $table = 'project';
    protected $fillable = [
       'name', 'desc','budget_range_id','user_id','created_at','updated_at',
    ];




}
