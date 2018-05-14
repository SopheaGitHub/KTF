<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $primaryKey = 'user_skill_id';

    protected $table = 'user_skill';
    protected $fillable = [
       'skill_id', 'budget_range_id', 'user_id','available_time','created_at','updated_at',
    ];

    public function getSkill($parent_id){
    	$result = DB::table(DB::raw('
				(SELECT
					*
				FROM
					skill 
				WHERE  parent_id = "'.$parent_id.'") as skill
			'))->get();
		return $result;
    }

    public function insertUserSkill($postDataUserSkill = []){
          //  $create = $skill->create($postDataUserSkill);

        // echo '<pre>';
        //     print_r($postDataUserSkill);
        // echo '</pre>';
        // exit();

        $sql = '';
        foreach ($postDataUserSkill['check_skill'] as $skill_id) {
                $sql .= " INSERT INTO `user_skill`(`skill_id`, 
                 `user_id`,`available_time`,`created_at`,`updated_at`) 
                VALUES (
                  '".$skill_id."',
                  '".$postDataUserSkill['user_id']."',
                  '".$postDataUserSkill['available_time']."',
                  '".$postDataUserSkill['created_at']."',
                  '".$postDataUserSkill['updated_at']."'); ";
        }
        if($sql != '') {
            DB::connection()->getPdo()->exec($sql);
        }
    }

    public function insertUserBudgetRange($postDataUserSkill = []){
        $sql1 = '';
        $sql1 .= " INSERT INTO `user_budget_range`(`budget_range_id`, `user_id`) 
                VALUES (
                  '".$postDataUserSkill['budget_range_id']."',
                  '".$postDataUserSkill['user_id']."'; ";
        if($sql1!='') {
            DB::connection()->getPdo()->exec($sql1);
        }
    }

    public function getAutocompleteSkills($filter_data=[]) {
      $result = DB::table(DB::raw("
        (SELECT
          *
        FROM
          skill 
        WHERE  skill_title like '%".$filter_data['filter_name']."%') as skill
      "))->get();
    return $result;

  }

     public function validationForm($datas=[]) {
        $rules = [
            'checkbox_skill'  => 'required',
        ];
        $messages = [
            'checkbox_skill.required' => trans('skill.skill_checkbox_required'),
        ];
        $validator = \Validator::make($datas['request'], $rules, $messages);
        return $validator;
    }



 






}
