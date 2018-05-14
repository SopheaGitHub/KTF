<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidProject extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'bid_project';
    protected $fillable = [
        'desc', 'contact','project_id','user_id','created_at','updated_at',
    ];



    public function validationForm($datas=[]) {
        $rules = [
            'timeframe_value'  => 'required|numeric',
            'amount'           => 'required|numeric',
            'desc'  => 'required|min:10',
            'contact'  => 'required'
        ];

        $messages = [
            'timeframe_value.required' => "Number of project timeframe is required",
            'timeframe_value.numeric'  => "Number of project timeframe allowed only number",
            'amount.required' => "Amount is required",
            'amount.numeric'  => "Amount allowed only number",
            'desc.required' => trans('Description is required'),
            'desc.min'      => trans('Description at least 10 digits'),
            'contact.required' => "Contact is required",
        ];
        $validator = \Validator::make($datas['request'], $rules, $messages);
        return $validator;
    }

}
