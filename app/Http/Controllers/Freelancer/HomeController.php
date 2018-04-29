<?php

namespace App\Http\Controllers\Freelancer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use App\Home;

class HomeController extends Controller
{


    protected $data = null;
    private   $date;
    public function __construct(){
        $this->data = new \stdClass();
        $this->homes = new Home();

        $this->date = date ("Y-m-d H:i:s");
    }

    public function index()
    {

        $filter = [
            'name' => '',
            'id' => '',
            'status' => '',
            'limit' => '5'
        ];

        $filter_freelancer = [
            'limit' => '4'
        ];

        $this->data->url_home = URL::to('/');
        $this->data->url_profile = URL::to('/profile');
        $this->data->url_post_project = URL::to('/freelancer/post_project_form');
        $this->data->url_project_detail_open = URL::to('/freelancer/project_detail_open');
        $this->data->url_project_search = URL::to('freelancer/searchproject/');
        $this->data->url_freelancer_search = URL::to('freelancer/searchfreelancer/');
        $this->data->url_search_freelancer = URL::to('freelancer/searchfreelancer/search');
        $this->data->url_search = URL::to('freelancer/searchproject/search');
        $this->data->url_skill =  URL::to('/freelancer/skill');
        $this->data->data_project_list  = $this->homes->getProjectList($filter)->get();
        $this->data->data_skill_list = \DB::table('skill')->get(['skill_title','skill_id']);
        $this->data->data_freelancer_list = $this->homes->getFreelancerList($filter_freelancer)->get();
//        print_r('<pre>');
//        echo  $this->data->data_freelancer_list;
//        print_r('</pre>');
//        exit();
       return  view('freelancer.home', ['data'=>$this->data]);

    }


}
