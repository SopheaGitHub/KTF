<?php

namespace App\Http\Controllers\Freelancer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;

class HomeController extends Controller
{


    protected $data = null;
    private   $date;
    public function __construct(){
        $this->data = new \stdClass();
        $this->date = date ("Y-m-d H:i:s");
    }

    public function index()
    {
        $this->data->url_home = URL::to('/');
        $this->data->url_profile = URL::to('/profile');
        $this->data->url_post_project = URL::to('/freelancer/post_project_form');
        $this->data->url_skill     =  URL::to('/freelancer/skill');
        return  view('freelancer.home', ['data'=>$this->data]);
    }


}
