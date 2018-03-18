<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class UserSkill extends Model
{

    public function getSkillByUserId($user_id){
        $result = DB::table(DB::raw('
				(SELECT
					skill_title
				FROM
					skill
				WHERE  skill_id IN (SELECT skill_id FROM user_skill WHERE user_id = "'.$user_id.'")) as user_skill
			'))->get();
        return $result;
    }
}
