<?php

namespace App\Http\Controllers;

use App\UserSkill;
use Illuminate\Http\Request;
use App\Http\Controllers\ConfigController;
use App\Skill;
use App\User;
use URL;
use Auth;

class ProfileController extends Controller
{

    protected $data = null;
    private  $user_skills,$date,$limit = 5;

    public function __construct(){
        $this->data = new \stdClass();
        $this->data->users = new User();
        $this->config = new ConfigController();
        $this->data->auth_id = ((Auth::check())? Auth::user()->id:'0');
        $this->data->dir_image_profile = $this->config->dir_image_profile;
        $this->data->dir_image_cover   = $this->config->dir_image_cover;
        $this->user_skills = new UserSkill();
        $this->date = date ("Y-m-d H:i:s");
    }

    public function index()
    {
        $user_id = \Auth::user()->user_id;
        $this->data->user_name = \DB::table('users')->where('user_id', '=', $user_id)->get(['user_firstname','user_lastname']);
        $this->data->user_profile = \DB::table('users')->where('user_id', '=', $user_id)->get(['profile','cover']);
        $this->data->url_store = URL::to('profile/store');
        $this->data->url_save_profile_image = URL::to('profile/save_profile');
        $this->data->url_save_cover_image = URL::to('profile/save_cover');
        $this->data->list_skill = $this->user_skills->getSkillByUserId($user_id);
        return  view('freelancer.profile', ['data'=>$this->data]);
    }

    public function saveProfile(Request $request){
        $user_id = \Auth::user()->user_id;
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

          return redirect('profile');
    }




    public function saveCover(Request $request){
        $user_id = \Auth::user()->user_id;
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

        return redirect('profile');
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



}
