<?php

namespace App\Http\Controllers\Freelancer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use App\Home;

class SearchFreelancerController extends Controller
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
        $paginate_data = \Request::all();
        $filter_freelancer = [
        ];
        $this->data->url_home = URL::to('/');
        $this->data->url_search = URL::to('freelancer/searchfreelancer/search');
        $this->data->url_profile = URL::to('/profile');
        $this->data->url_post_project = URL::to('/freelancer/post_project_form');
        $this->data->url_skill =  URL::to('/freelancer/skill');
        $this->data->data_status = \DB::table('status')->orderBy('status_id', 'ASC')->get(['status_id','status_name']);
        $this->data->data_budget_range = $this->homes->getBudgetRangeByGroup();
        $this->data->data_freelancer_list = $this->homes->getFreelancerList($filter_freelancer)->paginate(4)->setPath(url('/freelancer/searchfreelancer/search'))->appends($paginate_data);

        return  view('freelancer.search_freelancer', ['data'=>$this->data]);
    }



    public function search(Request $request){
//        print_r('<pre>');
//        echo  $request->curency_range;
//        print_r('</pre>');
//        exit();
        $paginate_data = \Request::all();

        $filter = [
            'name' => $request->txt_search,
            'budget' => $request->curency_range
        ];

        $this->data->data_input_search = $request->txt_search;
        $this->data->url_home = URL::to('/');
        $this->data->url_search = URL::to('freelancer/searchfreelancer/search');
        $this->data->url_profile = URL::to('/profile');
        $this->data->url_post_project = URL::to('/freelancer/post_project_form');
        $this->data->url_skill =  URL::to('/freelancer/skill');
        $this->data->data_freelancer_list = $this->homes->getFreelancerList($filter)->paginate(4)->setPath(url('/freelancer/searchfreelancer/search'))->appends($paginate_data);
        $this->data->data_skill_list = \DB::table('skill')->get(['skill_title','skill_id']);
        $this->data->data_budget_range = $this->homes->getBudgetRangeByGroup();
        $this->data->data_status_selected = $request->status;
        $this->data->data_budget_selected = $request->curency_range;
        return  view('freelancer.search_freelancer', ['data'=>$this->data]);
    }


}
