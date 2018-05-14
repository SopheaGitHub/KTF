<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class UserReviews extends Model
{



    public function validationForm($datas=[]) {
        $rules = [
            'desc'  => 'required',
            'rate_num'  => 'required',
        ];

        $messages = [
            'desc.required' => "Your comment is required",
            'rate_num.required' => "Your rate is required",
        ];
        $validator = \Validator::make($datas['request'], $rules, $messages);
        return $validator;
    }

}