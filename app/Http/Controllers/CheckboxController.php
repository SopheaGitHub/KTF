<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;

class CheckboxController extends Controller
{


 protected $data = null;
    

    public function __construct(){
        $this->data = new \stdClass();
        $this->date = date ("Y-m-d H:i:s");
    }


  public function index()
    {
    	$this->data->url_store = URL::to('/checkbox/store');
        return  view('checkbox', ['data'=>$this->data]);
    }



     public function store(Request $request)
    {
    	
        dd($request->all());
        exit();
    }



}