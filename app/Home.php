<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{

    public function getProjectList(){

        $db = DB::table('project as p')
            ->select(DB::raw('
                p.id,
                p.`name`,
                p.`desc`,
                p.created_at,
                u.user_id,
                u.`profile`,
                (SELECT GROUP_CONCAT(skill_id) FROM project_skill WHERE project_id = p.id) AS p_skill_id,
	br.min,
	br.max,
	c.currency_symbol'
            ))
            ->join('users AS u' , 'u.user_id', 'p.user_id')
            ->join('budget_range AS br','br.budget_range_id', 'p.budget_range_id')
            ->join('currency AS c','c.currency_id','br.currency_id')->limit(10);
        $result = $db->get();
		return $result;
    }


}
