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
                $sql .= " INSERT INTO `user_skill`(`skill_id`, `budget_range_id`,
                 `user_id`,`available_time`,`created_at`,`updated_at`) 
                VALUES (
                  '".$skill_id."',
                  '".$postDataUserSkill['budget_range_id']."',
                  '".$postDataUserSkill['user_id']."',
                  '".$postDataUserSkill['available_time']."',
                  '".$postDataUserSkill['created_at']."',
                  '".$postDataUserSkill['updated_at']."'); ";
        }

        if($sql!='') {
            DB::connection()->getPdo()->exec($sql);
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


  public function sfsd(){
      $db = DB::table(DB::raw('
        (
          SELECT
            cp.skill_id AS skill_id,
            GROUP_CONCAT(
              cd1. name
              ORDER BY
                cp. LEVEL SEPARATOR \'&nbsp;&nbsp;&gt;&nbsp;&nbsp;\'
            ) AS name,
            c1.parent_id,
            c1.sort_order
          FROM
            category_path cp
          LEFT JOIN category c1 ON (
            cp.category_id = c1.category_id
          )
          LEFT JOIN category c2 ON (cp.path_id = c2.category_id)
          LEFT JOIN category_description cd1 ON (cp.path_id = cd1.category_id AND cd1.language_id = \''.$filter_data['language_id'].'\')
          LEFT JOIN category_description cd2 ON (cp.category_id = cd2.category_id AND cd2.language_id = \''.$filter_data['language_id'].'\')
          GROUP BY
            cp.category_id
        ) AS category
      '));
    if ($filter_data['filter_name']!='') {
      $db->where('name', 'like', '%'.$filter_data['filter_name'].'%');
    }
    $db->orderBy($filter_data['sort'], $filter_data['order'])->take($filter_data['limit']);
    $result = $db->get();
    return $result;
  }







}
