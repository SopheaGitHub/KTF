<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'project_image';
    protected $fillable = [
       'path', 'file_name','project_id',
    ];
}
