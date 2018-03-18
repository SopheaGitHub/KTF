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

    public function validationForm($datas=[]) {
        $rules = [
            'txt_project_name'  => 'required|max:255',
            'txt_project_desc'  => 'required|min:10',
            'image'             => 'image', // mimes:jpeg,jpg,png
        ];

        $messages = [
            'txt_project_name.required' => trans('project.field_required'),
            'txt_project_name.max'      => trans('project.field_max_255'),
            'txt_project_desc.required' => trans('project.field_required'),
            'txt_project_desc.min'      => trans('project.field_min_10'),
            'image.image'               => trans('project.image'),
            'image.mimes'               => trans('project.pngjpg'),
        ];
        $validator = \Validator::make($datas['request'], $rules, $messages);
        return $validator;
    }



}
