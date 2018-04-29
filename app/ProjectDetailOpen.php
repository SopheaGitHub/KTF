<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ProjectDetailOpen extends Eloquent
{
    public function getProjectDetail($filter=[])
    {
        $db = DB::table('project as p')
            ->select(DB::raw('
                        u.user_id,
				        p.id,
				        p.name,
				        p.desc,
				        pi.file_name,
				        CONCAT(u.user_firstname," ",u.user_lastname) AS username,
				         u.profile,
				         p.created_at,
                        (SELECT GROUP_CONCAT(ps.skill_id,"--",s.skill_title) FROM project_skill AS ps INNER JOIN skill AS s ON s.skill_id = ps.skill_id WHERE ps.project_id = p.id ) AS project_skill,
		                (SELECT min FROM budget_range WHERE budget_range_id = p.budget_range_id) AS min,
                        (SELECT max FROM budget_range WHERE budget_range_id = p.budget_range_id) AS max,
                        (SELECT currency_id FROM budget_range WHERE budget_range_id = p.budget_range_id) AS currency
		    '))
         ->join('project_image AS pi' , 'p.id', 'pi.project_id')
         ->join('users AS u','u.user_id','p.user_id');
        if(isset($filter['id']) && $filter['id']!='') {
            $db->Where('p.id', $filter['id']);
        }
//        echo $db->toSql();
//        print_r($db->getBindings());
//        exit();
        return $db;
    }

    public function getListBidProject($filter=[])
    {
        $db = DB::table('bid_project AS bp')
            ->select(DB::raw('
                        u.user_id,
                        u.profile,
                        CONCAT(u.user_firstname," ",u.user_lastname) as username,
                        bp.desc,
                        bpb.amount,
                        (SELECT currency_name FROM currency where currency_id = bpb.currency_id) as currency_name,
                        bpt.duration,
                        (SELECT name FROM timeframe where id = bpt.timeframe_id ) as timeframe
		    '))
            ->join('bid_project_budget AS bpb' , 'bp.id', 'bpb.bid_project_id')
            ->join('bid_project_timeframe AS bpt','bp.id','bpt.bid_project_id')
            ->join('users AS u','u.user_id','bp.user_id');

        if(isset($filter['id']) && $filter['id']!='') {
            $db->Where('bp.project_id', $filter['id']);
        }
//        echo $db->toSql();
//        print_r($db->getBindings());
//        exit();
        return $db;
    }

    public function insertBidProject($postDataBidProject = []){
        $sql = '';
        $sql .= " INSERT INTO `bid_project`(`desc`, `contact`,
                 `project_id`,`user_id`,`created_at`,`updated_at`) 
                VALUES (
                  '".$postDataBidProject['desc']."',
                  '".$postDataBidProject['contact']."',
                   '".$postDataBidProject['project_id']."',
                  '".$postDataBidProject['user_id']."',
                  '".$postDataBidProject['created_at']."',
                  '".$postDataBidProject['updated_at']."'); ";
        if($sql!='') {
            DB::connection()->getPdo()->exec($sql);
        }
    }

}


