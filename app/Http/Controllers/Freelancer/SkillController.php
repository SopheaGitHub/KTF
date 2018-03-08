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
 		 		 	 $this->data->skill_by_parentid_1 = $this->skills->getSkill(1);
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
 		 	 	$user_id = Auth::user()->user_id;
 		 	 	 $postDataUserSkill = [
 		 	 	 	'check_skill'           => $request->checkbox_skill, 
 		 	 	 	'budget_range_id'       => $request->curency_range,
 		 	 	 	'user_id'               =>  $user_id,
 		 	 	 	'available_time'        => $request->available, 
 		 	 	 	'created_at'            => $this->date,
 		 	 	 	'updated_at'            => $this->date, ]; 
 		 	 	 $skill = $this->skills->insertUserSkill($postDataUserSkill); 
 		 	 	 $request->session()->flash('message','Intert Success!'); 
 		 	 	 return back(); 
 		 	 	} 
 		 	 }