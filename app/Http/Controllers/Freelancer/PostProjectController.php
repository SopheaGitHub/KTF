<?php

namespace App\Http\Controllers\Freelancer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ConfigController;
use App\Skill; 
use App\Currency;
use App\BudgetRange; 
use App\PostProject;
use App\ProjectImage;
use App\ProjectSkill;
use URL; 
use Auth;
use Image;
use File;
use DB;

class PostProjectController extends Controller
{
            protected $data = null;
            private  $skills,$date;
            public function __construct(){
                $this->middleware('auth');
                $this->data = new \stdClass(); 
                $this->config = new ConfigController();
                $this->postprojects = new PostProject();
                $this->protectimages = new ProjectImage();
                $this->projectskills = new ProjectSkill();
                $this->skills = new Skill(); 
                $this->currencies = new Currency();
                $this->budget_range = new BudgetRange();
                $this->date = date ("Y-m-d H:i:s"); 
                $this->data->dir_image = $this->config->dir_image;
     }

    public function index()
    {
    	 $this->data->go_skill_autocomplete = url('/skill/autocomplete');
         $this->data->url_store = URL::to('freelancer/postproject/store'); 
         $this->data->data_currency  = $this->currencies->getCurrency(); 
         $this->data->data_budget_range = $this->budget_range->getBudgetRangeByCurrencyID(1); 
         $this->data->data_skill = \DB::table('skill')->orderBy('order', 'ASC')->get(['skill_title','skill_id']);
        return  view('freelancer.post_project_form', ['data'=>$this->data]); 
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $requests = \Request::all();

        DB::beginTransaction();
        try {
            $validator = $this->postprojects->validationForm(['request'=>$requests]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

             $input = $request->all();
             $user_id = Auth::user()->user_id;
             if ($request->file('image')){
               $image = $request->file('image');
               $filename = time().'-'.str_slug(substr($input['txt_project_name'], 0, 8),"-").'.'.$image->GetClientOriginalExtension();
               $thumbPath = $this->data->dir_image.'/'.$user_id;
               File::makeDirectory($thumbPath, $mode = 0777, true, true);
               $input['image'] =  $filename;
               $image->move($thumbPath, $filename);
               }
               $user_id = Auth::user()->user_id;
               $projectDatas = [
                                'name'  => $request->txt_project_name,
                                'desc'  =>  $request->txt_project_desc,
                                'budget_range_id' => $request->curency_range,
                                'user_id'=> $user_id,
                                'created_at'  => $this->date,
                                'updated_at' =>   $this->date,
                            ];

             $project = $this->postprojects->create($projectDatas);

            if ($request->file('image')){
                 $projectimageDatas = [
                                    'path'       =>   $thumbPath,
                                    'file_name'  =>   $filename,
                                    'project_id' =>  $project->id,
                                ];
                 $this->protectimages->create($projectimageDatas);
             }

            if(isset($request->post_skill)){
                 $protectskillDatas = [
                                        'skill_id'   =>  $request->post_skill,
                                        'project_id' =>  $project->id,
                                    ];
                 $projectskill = $this->projectskills->addProjectSkill($protectskillDatas);
             }

            DB::commit();
             return redirect('/');

        } catch (Exception $e) {
            DB::rollback();
        }
        exit();
        
    }

    public function edit(Request $request){
        $filter = [
            'name' => '',
            'id' => $request->project_id,
            'status' => '',
            'limit' => '1'
        ];
        $this->data->go_skill_autocomplete = url('/skill/autocomplete');
        $this->data->url_update = URL::to('freelancer/postproject/update');
        $this->data->data_currency  = $this->currencies->getCurrency();
        $this->data->data_budget_range = $this->budget_range->getBudgetRangeByCurrencyID(1);
        $this->data->data_project_list  = $this->postprojects->getProjectList($filter)->get();
        $this->data->data_skill = \DB::table('skill')->orderBy('order', 'ASC')->get(['skill_title','skill_id']);

//        print_r('<pre>');
//        echo $this->data->data_project_list;
//        print_r('</pre>');
//        exit();
        return  view('freelancer.post_project_form', ['data'=>$this->data]);
    }



    public  function update(Request $request){

//        print_r('<pre>');
//        echo $request->project_id;
//        print_r('</pre>');
//        exit();


        $requests = \Request::all();
        $validator = $this->postprojects->validationForm(['request'=>$requests]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $user_id = Auth::user()->user_id;
        if ($request->file('image')){
            $image = $request->file('image');
            $filename = time().'-'.str_slug(substr($input['txt_project_name'], 0, 8),"-").'.'.$image->GetClientOriginalExtension();
            $thumbPath = $this->data->dir_image.'/'.$user_id;
            File::makeDirectory($thumbPath, $mode = 0777, true, true);
            $input['image'] =  $filename;
            $image->move($thumbPath, $filename);
        }





        $user_id = Auth::user()->user_id;
        $projectDatas = [
            'name'  => $request->txt_project_name,
            'desc'  =>  $request->txt_project_desc,
            'budget_range_id' => $request->curency_range,
            'user_id'=> $user_id,
            'created_at'  => $this->date,
            'updated_at' =>   $this->date,
        ];
        $project = $this->postprojects->where('id',$request->project_id)->update($projectDatas);


        if ($request->file('image')){
            $projectimageDatas = [
                'path'       =>   $thumbPath,
                'file_name'  =>   $filename,
                'project_id' =>  $request->project_id,
            ];
            $this->protectimages->where('id',31)->update($projectimageDatas);
        }

        $image_path = $request->file_path;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }


        //---process delete project skill before add new again

        $projectskill = $this->projectskills->where('project_id',$request->project_id)->delete();

        if(isset($request->post_skill)){
            $protectskillDatas = [
                'skill_id'   =>  $request->post_skill,
                'project_id' =>  $request->project_id,
            ];
            $projectskill = $this->projectskills->addProjectSkill($protectskillDatas);
       }


        return  redirect('/profile/'.$user_id);

    }

    public function show($id)
    {
        //
    }
}
