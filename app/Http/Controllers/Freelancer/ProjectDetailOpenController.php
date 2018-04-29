<?php

namespace App\Http\Controllers\Freelancer;

use App\BidProjectBudget;
use App\BidProjectTimeframe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use App\ProjectDetailOpen;
use App\UserSkill;
use App\BidProject;
use Auth;
use DB;

class ProjectDetailOpenController extends Controller
{

    protected $data = null;
    private   $date;
    public function __construct(){
        $this->middleware('auth');
        $this->data = new \stdClass();
        $this->user_skills = new UserSkill();
        $this->pdo = new ProjectDetailOpen();
        $this->bidpro = new BidProject();
        $this->bidprobudget = new BidProjectBudget();
        $this->bidproTimeFrame = new BidProjectTimeframe();
        $this->date = date ("Y-m-d H:i:s");
    }

    public function index(Request $request)
    {
        $filter = [
            'id' => $request->id
        ];
        $this->data->url_profile = URL::to('/profile');
        $this->data->url_bid_project = URL::to('freelancer/bid_project/store/');
        $this->data->project_id = $request->id;
        $this->data->data_project_detail = $this->pdo->getProjectDetail($filter)->get();
        $this->data->data_list_bid_project = $this->pdo->getListBidProject($filter)->get();
        $this->data->list_skill = $this->user_skills->getSkillByUserId($request->id);
       // print_r('<pre>');
//        echo    $this->data->data_list_bid_project ;
//        print_r('</pre>');
//        exit();
        return  view('freelancer.project_detail_open', ['data'=>$this->data]);
    }

    public function store(Request $request){
        \DB::beginTransaction();
        try {

            $postDataBidProject = [
                'user_id'  => Auth::user()->user_id,
                'project_id' => $request->project_id,
                'desc' => $request->desc,
                'contact' => $request->contact,
                'created_at' => $this->date,
                'updated_at' => $this->date
            ];
            //$this->data->create_bid_project = $this->pdo->insertBidProject($postDataBidProject)->get();
            $bidproject = $this->bidpro->create($postDataBidProject);
            $postDataBidProjectBudget = [
                'amount'  => $request->amount,
                'currency_id' => $request->currency,
                'bid_project_id' => $bidproject->id
            ];
            $bidprojectbudget = $this->bidprobudget->create($postDataBidProjectBudget);
            $postDataBidProjectTimeFrame = [
                'duration'  => $request->timeframe_value,
                'timeframe_id' => $request->timeframe,
                'bid_project_id' => $bidproject->id
            ];
//            print_r($postDataBidProjectTimeFrame);
//            exit();
            $bidprojecttimeframe = $this->bidproTimeFrame->create($postDataBidProjectTimeFrame);

            \DB::commit();
            return  redirect('/freelancer/project_detail_open/'.$request->project_id);
        } catch (\Exception $e) {
            \DB::rollback();
            echo $e->getMessage();
            exit();
        }
    }
}
