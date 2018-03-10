<?php

namespace App\Http\Controllers\Freelancer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

class PostProjectController extends Controller
{
            protected $data = null;
            private  $skills,$date; 
            public function __construct(){
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
	   //    if($request->hasFile('image')){
			 //    print_r($request->file('image')->getClientOriginalName());
		  // }else {
		  // 	echo 'No';
		  // }
	  
	  	 $input = $request->all();
    	 if ($request->file('image')){
           $image = $request->file('image');
         $filename = time().'-'.str_slug($input['txt_project_name'],"-").'.'.$image->GetClientOriginalExtension();
           $thumbPath = $this->data->dir_image;
           $input['image'] =  $filename;
           $image->move($thumbPath, $filename);
           print_r($filename);
           }else{
           	print_r ('else');
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

         $projectimageDatas = [
          					'path'       =>   $thumbPath,
          					'file_name'  =>   $filename,
          					'project_id' =>  $project->id,
          				];
         $this->protectimages->create($projectimageDatas); 	

         $protectskillDatas = [
         						'skill_id'   =>  $request->post_skill,
         						'project_id' =>  $project->id,
         					];		
         $projectskill = $this->projectskills->addProjectSkill($protectskillDatas); 						

        
    }

    public function show($id)
    {
        //
    }
}
