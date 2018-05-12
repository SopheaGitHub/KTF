<?php 
namespace App\Http\Controllers\Freelancer;
 use Illuminate\Http\Request; 
 use App\Http\Controllers\Controller; 
 use App\Skill; 
 use App\Currency;
 use App\BudgetRange; 
 use URL; 
 use Auth; 
 class SkillController extends Controller
 		 {
 		 	protected $data = null;
 		 	private  $skills,$date; 
 		 	public function __construct(){
                $this->middleware('auth');
 		 		$this->data = new \stdClass(); 
 		 		$this->skills = new Skill(); 
 		 		$this->currencies = new Currency();
 		 		 $this->budget_range = new BudgetRange();
 		 		  $this->date = date ("Y-m-d H:i:s"); 
 		 		} 

 		 	public function index() {
 		 		$this->data->main_categories = \DB::table('skill')->where('parent_id', '=', '0')->orderBy('order', 'ASC')->get(['skill_title','skill_id']);
 		 		 $this->data->url_store = URL::to('freelancer/skill/store'); 
 		 		 foreach($this->data->main_categories as $value) {
 		 		 	$id = $value->skill_id; 
 		 		 	$skill_title = $value->skill_title;
 		 		 	 $this->data->$skill_title = $this->skills->getSkill($id); 
 		 		 	}
 		 		 	 $this->data->data_currency  = $this->currencies->getCurrency(); 
 		 		 	 $this->data->data_budget_range = $this->budget_range->getBudgetRangeByCurrencyID(1); 
 		 		 	 return  view('freelancer.skill', ['data'=>$this->data]); 
 		 		 	} 

 		 	public function loadCurrency(Request $request){
 		 		$currency_id = $request->currency_id; 
 		 		$this->data->data_budget_range = $this->budget_range->getBudgetRangeByCurrencyID($currency_id); 
 		 		return  view('freelancer.load_currency', ['data'=>$this->data]);
 		 		 }

 		 	 public function store(Request $request) {

                   // $validatedData = $request->validate([
                   //      'checkbox_skill' => 'required',
                   //   ]);

                   $requests = \Request::all();
                    $validator = $this->skills->validationForm(['request'=>$requests]);
                    if ($validator->fails()) {
                        return back()->withErrors($validator)->withInput();
                    }

 		 	 	$user_id = Auth::user()->user_id;
 		 	 	 $postDataUserSkill = [
 		 	 	 	'check_skill'           => $request->checkbox_skill, 
 		 	 	 	'budget_range_id'       => $request->curency_range,
 		 	 	 	'user_id'               =>  $user_id,
 		 	 	 	'available_time'        => $request->available, 
 		 	 	 	'created_at'            => $this->date,
 		 	 	 	'updated_at'            => $this->date, ]; 
 		 	 	 $skill = $this->skills->insertUserSkill($postDataUserSkill);
 		 	 	 $user_budget_range = $this->skills->insertUserBudgetRange($postDataUserSkill);
 		 	 	 $request->session()->flash('message','Insert Success!');
 		 	 	 return redirect('/profile');
 		 	 	} 



 	public function autocomplete(){
    	 $request = \Request::all(); 	 
         $json = [];

             if (isset($request['filter_name'])) {

            $filter_data = [
                'filter_name' => $request['filter_name'],
                'sort'        => 'skill_title',
                'order'       => 'ASC',
                'start'       => 0,
                'limit'       => 100
            ];

            $results = $this->skills->getAutocompleteSkills($filter_data);

            foreach ($results as $result) {
                $json[] = [
                    'skill_id' => $result->skill_id,
                    'skill_title'    => strip_tags(html_entity_decode($result->skill_title, ENT_QUOTES, 'UTF-8'))
                ];
            }
        }

        $sort_order = [];

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['skill_title'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        return json_encode($json);

    }

}