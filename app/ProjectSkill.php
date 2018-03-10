<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProjectSkill extends Model
{
    

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
}
