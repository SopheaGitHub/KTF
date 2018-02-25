<?php

namespace KTF;

use Illuminate\Database\Eloquent\Model as Eloquent;
use DB;

class Users extends Eloquent
{
    protected $table = 'users';
    public function insertUsers($postDataUser = []){
    		$sql = '';
    		$sql .= " INSERT INTO `users`(`user_firstname`, `user_lastname`, 
    		   `user_phoneno`, `user_email`,`user_password`,`created_at`, `updated_at`) 
    		  VALUES ('".$postDataUser['user_firstname']."', 
    		  		'".$postDataUser['user_lastname']."',
    		   		'".$postDataUser['user_phoneno']."',
    		    	'".$postDataUser['user_email']."',
    		    	'".$postDataUser['user_password']."',
    		    	'".$postDataUser['created_at']."',
    		     	'".$postDataUser['updated_at']."'); ";
    		DB::connection()->getPdo()->exec($sql);
    }
}
