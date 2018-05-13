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
use App\UserReviews;
use Auth;
use DB;

class ProjectDetailOpenController extends Controller
{
    protected $data = null;
    private $date;

    public function __construct()
    {
        $this->middleware('auth');
        $this->data = new \stdClass();
        $this->user_skills = new UserSkill();
        $this->pdo = new ProjectDetailOpen();
        $this->bidpro = new BidProject();
        $this->bidprobudget = new BidProjectBudget();
        $this->bidproTimeFrame = new BidProjectTimeframe();
        $this->userreviews = new UserReviews();
        $this->date = date("Y-m-d H:i:s");
    }

    public function index(Request $request)
    {
        $filter = [
            'id' => $request->id
        ];
        $user_id = \Auth::user()->user_id;
        $this->data->data_user_id = $user_id;
        $this->data->url_profile = URL::to('/profile');
        $this->data->url_bid_project = URL::to('freelancer/bid_project/store/');
        $this->data->url_offered_project = URL::to('freelancer/bid_project/update/');
        $this->data->url_close_project = URL::to('freelancer/bid_project/close/');
        $this->data->project_id = $request->id;
        $this->data->data_project_detail = $this->pdo->getProjectDetail($filter)->get();
        $this->data->data_list_bid_project = $this->pdo->getListBidProject($filter)->get();
        $this->data->list_skill = $this->user_skills->getSkillByUserId($request->id);

        $userid = DB::table('bid_project')
            ->where('project_id', 15)
            ->where('offered', 1)
            ->first()->user_id;

        $filter_offered_user = [
            'user_id' => $userid
        ];
        $this->data->data_user_offered = $this->pdo->getUserOfffered($filter_offered_user)->get();
//        print_r('<pre>');
//        echo   $this->data->data_project_detail ;
//        print_r('</pre>');
//        exit();
        return view('freelancer.project_detail_open', ['data' => $this->data]);
    }

    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {

            $requests = \Request::all();
            $validator = $this->bidpro->validationForm(['request'=>$requests]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }


            $postDataBidProject = [
                'user_id' => Auth::user()->user_id,
                'project_id' => $request->project_id,
                'desc' => $request->desc,
                'contact' => $request->contact,
                'created_at' => $this->date,
                'updated_at' => $this->date
            ];
            //$this->data->create_bid_project = $this->pdo->insertBidProject($postDataBidProject)->get();
            $bidproject = $this->bidpro->create($postDataBidProject);
            $postDataBidProjectBudget = [
                'amount' => $request->amount,
                'currency_id' => $request->currency,
                'bid_project_id' => $bidproject->id
            ];
            $bidprojectbudget = $this->bidprobudget->create($postDataBidProjectBudget);
            $postDataBidProjectTimeFrame = [
                'duration' => $request->timeframe_value,
                'timeframe_id' => $request->timeframe,
                'bid_project_id' => $bidproject->id
            ];
//            print_r($postDataBidProjectTimeFrame);
//            exit();
            $bidprojecttimeframe = $this->bidproTimeFrame->create($postDataBidProjectTimeFrame);

            \Session::flash('flash_message','successfully Bid Project');
            \DB::commit();
            return redirect('/freelancer/project_detail_open/' . $request->project_id);
        } catch (\Exception $e) {
            \DB::rollback();
            echo $e->getMessage();
            exit();
        }
    }

    public function update(Request $request)
    {
//        echo $request->project_id;
//        exit();
        DB::table('bid_project')
            ->where('id',$request->bid_id)
            ->update([
                "offered" => 1
            ]);


        DB::table('project')
            ->where('id',$request->project_id)
            ->update([
                "status_id" => 2
            ]);
        \Session::flash('flash_message','successfully Offered Project');
        return redirect('/freelancer/project_detail_open/' . $request->project_id);
    }

    public function close(Request $request)
    {

//        print_r('<pre>');
//        echo   $request->star_rate;
//        echo   $request->txt_review;
//        print_r('</pre>');
//        exit();

        $requests = \Request::all();
        $validator = $this->userreviews->validationForm(['request'=>$requests]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user_id = \Auth::user()->user_id;
        DB::table('user_reviews')->insert(
            ['rate_from' => $user_id, 'rate_to' => $request->offered_user_id,'rate_num'=> $request->rate_num,'desc' => $request->desc,'created_at'=>$this->date]
        );

        DB::table('project')
            ->where('id',$request->project_id)
            ->update([
                "status_id" => 3
            ]);

        \Session::flash('flash_message','successfully Close Project');
        return redirect('/freelancer/project_detail_open/' . $request->project_id);
    }
}
