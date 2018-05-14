<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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





    public function getProjectList($filter=[]){

        $db = DB::table('project as p')
            ->select(DB::raw('
                p.id,
                p.`name`,
                p.`desc`,
                p.created_at,
                p.user_id,
                (SELECT status_name FROM status WHERE status_id = p.status_id) AS status,
                p.status_id,
                CONCAT(u.user_firstname," ",u.user_firstname) as username,
                u.`profile`,
                p.budget_range_id,
                (SELECT GROUP_CONCAT(skill_id) FROM project_skill WHERE project_id = p.id) AS p_skill_id,
	br.min,
	br.max,
	c.currency_symbol,
    c.currency_id,
    (SELECT CONCAT(path,"/",file_name) FROM project_image WHERE project_id = p.id) AS path_and_file_name'
            ))
            ->join('users AS u' , 'u.user_id', 'p.user_id')
            ->join('budget_range AS br','br.budget_range_id', 'p.budget_range_id')
            ->join('currency AS c','c.currency_id','br.currency_id');

        if(isset($filter['name']) && $filter['name']!='') {
            $db->Where('p.name', 'like', '%' . $filter['name'] . '%')
                ->Orwhere('p.desc', 'like', '%' . $filter['name'] . '%');
        }
        if(isset($filter['id']) && $filter['id']!='') {
            $db->Where('p.id',$filter['id']);
        }
        if(isset($filter['status']) && $filter['status']!='') {
            $db->Where('p.status_id',$filter['status']);
        }

        if(isset($filter['budget']) && $filter['budget']!='') {
            $db->WhereIn('p.budget_range_id', preg_split('/\,/', $filter['budget']) );
        }

        if(isset($filter['limit']) && $filter['limit']!='') {
            $db->limit($filter['limit']);
        }

        $db->orderby('p.id','DESC');

//        echo $db->toSql();
//        print_r($db->getBindings());

        return $db;
    }



}
