<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Home extends Eloquent
{

    public function getProjectList($filter=[]){

        $db = DB::table('project as p')
            ->select(DB::raw('
                p.id,
                p.`name`,
                p.`desc`,
                p.created_at,
                u.user_id,
                p.status_id,
                u.`profile`,
                p.budget_range_id,
                (SELECT GROUP_CONCAT(skill_id) FROM project_skill WHERE project_id = p.id) AS p_skill_id,
	br.min,
	br.max,
	c.currency_symbol'
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
        $db->orderby('p.id','DESC');

//        echo $db->toSql();
//        print_r($db->getBindings());

		return $db;
    }



    public function getBudgetRangeByCurrencyID(){
        $result = DB::table(DB::raw('
				(SELECT
					*
				FROM
					budget_range 
			 ) as br
			'))->get();
        return $result;
    }


    public function getBudgetRangeByGroup(){
        $result = DB::table(DB::raw('
				(
				SELECT
                        GROUP_CONCAT(min) as min,
                        GROUP_CONCAT(max) as max,
                        `group`,
                        GROUP_CONCAT(budget_range_id) as budget_range_id

                FROM
	                    budget_range
                GROUP BY
                    	`group`
			 ) as brg
			'))->get();
        return $result;
    }


}
