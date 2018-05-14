<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProjectSkill extends Model
{


    protected $table = 'project_skill';
    protected $fillable = [
        'skill_id', 'project_id',
    ];

     public function addProjectSkill($postDataProjectSkill = []){
     
        $sql = '';
        foreach ($postDataProjectSkill['skill_id'] as $skill_id) {
                $sql .= " INSERT INTO `project_skill`(`skill_id`, `project_id`) 
                VALUES (
                  '".$skill_id."',
                  '".$postDataProjectSkill['project_id']."'); ";
        }
        if($sql!='') {
            DB::connection()->getPdo()->exec($sql);
        }
    }


//    public function updateProjectSkill($postDataProjectSkill = []){
//        $sql = '';
//        foreach ($postDataProjectSkill['skill_id'] as $skill_id) {
//            $sql .= " UPDATE `project_skill`
//                      SET `skill_id` = '".$skill_id."',
//                     `project_id` =  '".$postDataProjectSkill['project_id']."'
//                      WHERE 'dfdf' =  '".$postDataProjectSkill['project_id']."'
//                ";
//        }
//        if($sql!='') {
//            DB::connection()->getPdo()->exec($sql);
//        }
//    }



}
