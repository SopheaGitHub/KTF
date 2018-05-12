<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
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
                CONCAT(u.user_firstname," ",u.user_lastname) as username,
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

        if(isset($filter['user_id']) && $filter['user_id']!='') {
            $db->Where('u.user_id',$filter['user_id']);
        }
        if(isset($filter['name']) && $filter['name']!='') {
            $db->Where('p.name', 'like', '%' . $filter['name'] . '%');
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



    public function getBidProjectList($filter=[]){

        $db = DB::table('project as p')
            ->select(DB::raw('
                p.id,
                p.`name`,
                p.`desc`,
                p.created_at,
                p.user_id,
                bp.id as bid_project_id,
                bp.desc,
                bp.contact,
                
                (SELECT id FROM bid_project_budget as bpb WHERE bid_project_id = bp.id ) as bid_project_budget_id,
                (SELECT id FROM bid_project_timeframe as bpt WHERE bid_project_id = bp.id ) as bid_project_timeframe_id,
             
                (SELECT amount FROM bid_project_budget as bpb WHERE bid_project_id = bp.id ) as amount,
                (SELECT currency_id FROM bid_project_budget as bpb WHERE bid_project_id = bp.id ) as currencyid,
                (SELECT currency_name FROM currency where currency_id = currencyid) as currency_name,
                
                
                 (SELECT duration FROM bid_project_timeframe as bpt WHERE bid_project_id = bp.id ) as duration,
                 
               
                (SELECT status_name FROM status WHERE status_id = p.status_id) AS status,
                p.status_id,
                CONCAT(u.user_firstname," ",u.user_lastname) as username,
                u.`profile`,
                p.budget_range_id,
                (SELECT GROUP_CONCAT(skill_id) FROM project_skill WHERE project_id = p.id) AS p_skill_id,
	br.min,
	br.max,
	c.currency_symbol'
            ))
            ->join('users AS u' , 'u.user_id', 'p.user_id')
            ->join('budget_range AS br','br.budget_range_id', 'p.budget_range_id')
            ->join('currency AS c','c.currency_id','br.currency_id')
            ->join('bid_project AS bp','p.id','bp.project_id');

           // ->join('bid_project_timeframe AS bpt','bp.id','bpt.bid_project_id');

        if(isset($filter['user_id']) && $filter['user_id']!='') {
            $db->Where('bp.user_id',$filter['user_id']);
        }
        if(isset($filter['name']) && $filter['name']!='') {
            $db->Where('p.name', 'like', '%' . $filter['name'] . '%');
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




    public function getReviewsList($filter=[]){
        $db = DB::table('user_reviews as ur')
            ->select(DB::raw('
                	ur.rate_from,
                    ur.rate_to,
                    ur.rate_num,
                    ur.`desc`,
                    ur.created_at,
                    (SELECT u.`profile` FROM users AS u WHERE u.user_id = ur.rate_from) as profile,
                    (SELECT CONCAT(u.user_firstname," ",u.user_lastname) FROM users AS u WHERE u.user_id = ur.rate_from) as username,
                    (SELECT GROUP_CONCAT(us.skill_id,"--",s.skill_title) FROM user_skill AS us INNER JOIN skill AS s ON s.skill_id = us.skill_id WHERE user_id = ur.rate_from) AS user_skill,
           
                   (SELECT ubr.budget_range_id FROM user_budget_range AS ubr WHERE ubr.user_id = ur.rate_from) as budgetrangeid,
                   (SELECT min FROM budget_range WHERE budget_range_id = budgetrangeid) AS min,
                   (SELECT max FROM budget_range WHERE budget_range_id = budgetrangeid) AS max,
                   (SELECT currency_id FROM budget_range WHERE budget_range_id = budgetrangeid) AS currency
            '));

        if(isset($filter['user_id']) && $filter['user_id']!='') {
            $db->Where('ur.rate_to',$filter['user_id']);
        }
        if(isset($filter['limit']) && $filter['limit']!='') {
            $db->limit($filter['limit']);
        }

        $db->orderby('ur.created_at','DESC');

//        echo $db->toSql();
//        print_r($db->getBindings());

        return $db;
    }

}
