<?php

namespace App\Http\Controllers;

use App\BidProject;
use App\UserSkill;
use Illuminate\Http\Request;
use App\Http\Controllers\ConfigController;
use App\Skill;
use App\User;
use App\Profile;
use URL;
use Auth;
use DB;

class ProfileController extends Controller
{

    protected $data = null;
    private  $user_skills,$date,$limit = 5;

    public function __construct(){
        $this->middleware('auth');
        $this->data = new \stdClass();
        $this->data->users = new User();
        $this->config = new ConfigController();
        $this->data->auth_id = ((Auth::check())? Auth::user()->id:'0');
        $this->data->dir_image_profile = $this->config->dir_image_profile;
        $this->data->dir_image_cover   = $this->config->dir_image_cover;
        $this->user_skills = new UserSkill();
        $this->profile = new Profile();
        $this->bid_project = new BidProject();
        $this->date = date ("Y-m-d H:i:s");
    }

    public function index(Request $request)
    {
        $user_id = $request->id;
//        $user_id = \Auth::user()->user_id;

        $this->data->url_home = URL::to('/');
        $this->data->url_profile = URL::to('/profile');
        $this->data->url_post_project = URL::to('/freelancer/post_project_form');
        $this->data->url_skill     =  URL::to('/freelancer/skill');

        $this->data->user_name = \DB::table('users')->where('user_id', '=', $user_id)->get(['user_firstname','user_lastname']);
        $this->data->user_profile = \DB::table('users')->where('user_id', '=', $user_id)->get(['profile','cover']);
        //print_r('<pre>');
//        echo   $this->data->user_profile;
//        print_r('</pre>');
//        exit();

        $this->data->url_store = URL::to('profile/store');
        $this->data->url_save_profile_image = URL::to('profile/save_profile/'.$user_id);
        $this->data->url_save_cover_image = URL::to('profile/save_cover/'.$user_id);
        $this->data->list_skill = $this->user_skills->getSkillByUserId($user_id);


        $paginate_data = \Request::all();
        $filter = [
            'user_id' => $user_id,
        ];
        $this->data->data_review_list  = $this->profile->getReviewsList($filter)->paginate(2)->setPath(url('/profile/'.$user_id))->appends($paginate_data);

        return  view('freelancer.profile', ['data'=>$this->data]);
    }

    public function saveProfile(Request $request){
        $user_id = $request->id;
        $request = \Request::all();
        $username = 'profile_'.((Auth::check())? str_replace(' ', '', strtolower(Auth::user()->name)):'0').$user_id;
        $file_path = $user_id.'/profile/';
        $this->base64_decode_profile($request['image-profile'], $username, $file_path);
        $this->data->users->where('user_id', '=', $user_id)->update(['profile'=>'images/profile'.$file_path.$username.'.jpg']);
        // remove old profile
        if (file_exists($this->data->dir_image_profile.'cache/'.$file_path.$username.'-120x80.jpg')) {
            unlink($this->data->dir_image_profile.'cache/'.$file_path.$username.'-120x80.jpg');
        }
        if (file_exists($this->data->dir_image_profile.'cache/'.$file_path.$username.'-600x400.jpg')) {
            unlink($this->data->dir_image_profile.'cache/'.$file_path.$username.'-600x400.jpg');
        }
        if (file_exists($this->data->dir_image_profile.'cache/'.$file_path.$username.'-850x280.jpg')) {
            unlink($this->data->dir_image_profile.'cache/'.$file_path.$username.'-850x280.jpg');
        }

        if(isset($request['original_image']) && $request['original_image'] != '') {
            if (file_exists($this->data->dir_image_profile.'cache/'.$file_path.'ori_'.$username.'-100x100.jpg')) {
                unlink($this->data->dir_image_profile.'cache/'.$file_path.'ori_'.$username.'-100x100.jpg');
            }
            if (file_exists($this->data->dir_image_profile.'cache/'.$file_path.'ori_'.$username.'-120x80.jpg')) {
                unlink($this->data->dir_image_profile.'cache/'.$file_path.'ori_'.$username.'-120x80.jpg');
            }
            if (file_exists($this->data->dir_image_profile.'cache/'.$file_path.'ori_'.$username.'-600x400.jpg')) {
                unlink($this->data->dir_image_profile.'cache/'.$file_path.'ori_'.$username.'-600x400.jpg');
            }

            // $ori_extension = pathinfo($request['original_image'], PATHINFO_EXTENSION);
            copy($request['original_image'], $this->data->dir_image_profile.'/'.$file_path.'ori_'.$username.'.jpg');
        }

          return redirect('profile/'.$user_id);
    }

    public function saveCover(Request $request){
        $user_id = $request->id;
        $request = \Request::all();
        $username = 'cover_'.((Auth::check())? str_replace(' ', '', strtolower(Auth::user()->name)):'0').$user_id;
        $file_path = $user_id.'/cover/';
        $this->base64_decode_cover($request['image-cover'], $username, $file_path);
        $this->data->users->where('user_id', '=', $user_id)->update(['cover'=>'images/cover'.$file_path.$username.'.jpg']);
        // remove old profile
        if (file_exists($this->data->dir_image_cover.'cache/'.$file_path.$username.'-120x80.jpg')) {
            unlink($this->data->dir_image_cover.'cache/'.$file_path.$username.'-120x80.jpg');
        }
        if (file_exists($this->data->dir_image_cover.'cache/'.$file_path.$username.'-600x400.jpg')) {
            unlink($this->data->dir_image_cover.'cache/'.$file_path.$username.'-600x400.jpg');
        }
        if (file_exists($this->data->dir_image_cover.'cache/'.$file_path.$username.'-850x280.jpg')) {
            unlink($this->data->dir_image_cover.'cache/'.$file_path.$username.'-850x280.jpg');
        }

        if(isset($request['original_image']) && $request['original_image'] != '') {
            if (file_exists($this->data->dir_image_cover.'cache/'.$file_path.'ori_'.$username.'-100x100.jpg')) {
                unlink($this->data->dir_image_cover.'cache/'.$file_path.'ori_'.$username.'-100x100.jpg');
            }
            if (file_exists($this->data->dir_image_cover.'cache/'.$file_path.'ori_'.$username.'-120x80.jpg')) {
                unlink($this->data->dir_image_cover.'cache/'.$file_path.'ori_'.$username.'-120x80.jpg');
            }
            if (file_exists($this->data->dir_image_cover.'cache/'.$file_path.'ori_'.$username.'-600x400.jpg')) {
                unlink($this->data->dir_image_cover.'cache/'.$file_path.'ori_'.$username.'-600x400.jpg');
            }

            // $ori_extension = pathinfo($request['original_image'], PATHINFO_EXTENSION);
            copy($request['original_image'], $this->data->dir_image_cover.'/'.$file_path.'ori_'.$username.'.jpg');
        }

        return redirect('profile/'.$user_id);
    }

    public function base64_decode_profile($code, $username, $file_path, $extention='.jpg') {
        $saveImage = $username.''.$extention;
        $data = $code;
        $info = getimagesize($code);
        list($t, $data) = explode(';', $data);
        list($t, $data)  = explode(',', $data);
        $source_url = base64_decode($data);

        $directory = $this->data->dir_image_profile.$file_path;
        // create user diractory
        if(!is_dir($directory)) {
            mkdir($directory, 0777, true);
            chmod($directory, 0777);

//            if (!file_exists($directory.'index.html')) {
//                $myfile = fopen($directory.'index.html', 'w');
//                fwrite($myfile, "Page not found.");
//                fclose($myfile);
//            }
        }

        $image = imagecreatefromstring($source_url);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        if ($info['mime'] == 'image/jpeg') {
            imagejpeg($image, $directory.$saveImage);
        } elseif ($info['mime'] == 'image/pjpeg') {
            imagejpeg($image, $directory.$saveImage);
        } elseif ($info['mime'] == 'image/gif') {
            imagejpeg($image, $directory.$saveImage);
        } elseif ($info['mime'] == 'image/png') {
            imagepng($image, $directory.$saveImage);
        } elseif ($info['mime'] == 'image/x-png') {
            imagepng($image, $directory.$saveImage);
        }
    }


    public function base64_decode_cover($code, $username, $file_path, $extention='.jpg') {
        $saveImage = $username.''.$extention;
        $data = $code;
        $info = getimagesize($code);
        list($t, $data) = explode(';', $data);
        list($t, $data)  = explode(',', $data);
        $source_url = base64_decode($data);

        $directory = $this->data->dir_image_cover.$file_path;
        // create user diractory
        if(!is_dir($directory)) {
            mkdir($directory, 0777, true);
            chmod($directory, 0777);

//            if (!file_exists($directory.'index.html')) {
//                $myfile = fopen($directory.'index.html', 'w');
//                fwrite($myfile, "Page not found.");
//                fclose($myfile);
//            }
        }

        $image = imagecreatefromstring($source_url);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        if ($info['mime'] == 'image/jpeg') {
            imagejpeg($image, $directory.$saveImage);
        } elseif ($info['mime'] == 'image/pjpeg') {
            imagejpeg($image, $directory.$saveImage);
        } elseif ($info['mime'] == 'image/gif') {
            imagejpeg($image, $directory.$saveImage);
        } elseif ($info['mime'] == 'image/png') {
            imagepng($image, $directory.$saveImage);
        } elseif ($info['mime'] == 'image/x-png') {
            imagepng($image, $directory.$saveImage);
        }
    }


    public function loadProjectList(Request $request){
      $filter = [
          'user_id' => '',
          'name' => $request->project_name,
          'id' => $request->id,
          'status' => $request->status,
          'limit' => '100'
      ];
      $this->data->data_project_list  = $this->profile->getProjectList($filter)->get();
      $this->data->data_status = \DB::table('status')->orderBy('status_id', 'ASC')->get(['status_id','status_name']);
      $this->data->data_status_selected = $request->status;
      $this->data->data_project_id = $request->id;
      $this->data->data_project_name = $request->project_name;
      return  view('component.project',['data'=>$this->data]);
  }


    public function loadBidList(Request $request){
        $user_id = \Auth::user()->user_id;
        $filter = [
            'user_id' => $user_id,
            'name' => $request->project_name,
            'id' => $request->id,
            'status' => $request->status,
            'limit' => '100'
        ];
        $this->data->url_bid_project = URL::to('freelancer/profile_bid_project/update/');
        $this->data->data_project_list  = $this->profile->getBidProjectList($filter)->get();
        $this->data->data_status = \DB::table('status')->orderBy('status_id', 'ASC')->get(['status_id','status_name']);
        $this->data->data_status_selected = $request->status;
        $this->data->data_project_id = $request->id;
        $this->data->data_project_name = $request->project_name;
        $this->data->data_currency = \DB::table('currency')->orderBy('currency_id', 'ASC')->get(['currency_id','currency_name']);
        $this->data->data_timeframe = \DB::table('timeframe')->orderBy('id', 'ASC')->get(['id','name']);
        return  view('component.bid',['data'=>$this->data]);
    }


    public function loadReviewList(Request $request){
        $user_id = \Auth::user()->user_id;
        $paginate_data = \Request::all();
        $filter = [
            'user_id' => $user_id,
        ];
        $this->data->data_review_list  = $this->profile->getReviewsList($filter)->paginate(2)->setPath(url('/profile/'.$user_id))->appends($paginate_data);
        $this->data->url_profile = URL::to('/profile');
        $this->data->list_skill = $this->user_skills->getSkillByUserId($user_id);
        return  view('component.overview',['data'=>$this->data]);
    }


    public function updateBidProject(Request $request){
//        print_r('<pre>');
//        echo   $request->project_id;
//        print_r('</pre>');
//        exit();

        $requests = \Request::all();
        $validator = $this->bid_project->validationForm(['request'=>$requests]);
        if ($validator->fails()) {
           // return back()->withErrors($validator)->withInput();
            return redirect('/edit_bid_project_error')->withErrors($validator)->withInput();
        }


        $user_id = \Auth::user()->user_id;
        DB::table('bid_project')
            ->where('id',$request->bid_project_id)
            ->update([
                "desc" => $request->desc,
                "contact" => $request->contact
            ]);
        DB::table('bid_project_budget')
            ->where('id',$request->bid_project_budget_id)
            ->update([
                "amount" => $request->amount,
                "currency_id"=> $request->currency
            ]);
        DB::table('bid_project_timeframe')
            ->where('id',$request->bid_project_timeframe_id)
            ->update([
                "duration" => $request->timeframe_value,
                "timeframe_id"=> $request->timeframe
            ]);
        \Session::flash('flash_message','successfully Offered Project');
        return redirect('/profile/' . $user_id);

    }



    public function updateBidProjectWithError(Request $request){
        $this->data->url_bid_project = URL::to('freelancer/profile_bid_project/update/');
        $this->data->data_currency = \DB::table('currency')->orderBy('currency_id', 'ASC')->get(['currency_id','currency_name']);
        $this->data->data_timeframe = \DB::table('timeframe')->orderBy('id', 'ASC')->get(['id','name']);
        return  view('freelancer.updatebidprojectwitherror', ['data'=>$this->data]);
    }











}
