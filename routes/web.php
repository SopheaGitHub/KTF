<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/checkbox','CheckboxController@index');
Route::post('/checkbox/store','CheckboxController@store');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('login/google', 'Auth\LoginController@redirectToProvider2');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback2');


//==================> Freelancer <========================
Route::get('/freelancer/skill','Freelancer\SkillController@index');
Route::get('/freelancer/success','Auth\RegisterController@success');
Route::get('/freelancer/skill','Freelancer\SkillController@index');
Route::post('/freelancer/skill/store','Freelancer\SkillController@store');
Route::get('/currency_range','Freelancer\SkillController@loadCurrency');
Route::get('/freelancer/post_project_form','Freelancer\PostProjectController@index');
Route::get('/skill/autocomplete','Freelancer\SkillController@autocomplete');
Route::post('/freelancer/postproject/store','Freelancer\PostProjectController@store');
Route::get('/profile','ProfileController@index');
Route::post('/profile/save_profile/{id}','ProfileController@saveProfile');
Route::post('/profile/save_cover/{id}','ProfileController@saveCover');
Route::get('/','Freelancer\HomeController@index');
Route::get('/freelancer/searchproject','Freelancer\SearchProjectController@index');
Route::get('/freelancer/searchproject/search','Freelancer\SearchProjectController@search');
Route::get('/freelancer/searchfreelancer','Freelancer\SearchFreelancerController@index');
Route::get('/freelancer/searchfreelancer/search','Freelancer\SearchFreelancerController@search');
Route::get('/profile/{id}', 'ProfileController@index');

Route::get('/freelancer/project_detail_open/{id}','Freelancer\ProjectDetailOpenController@index');
Route::POST('freelancer/bid_project/store','Freelancer\ProjectDetailOpenController@store');
Route::POST('freelancer/bid_project/update','Freelancer\ProjectDetailOpenController@update');
Route::POST('freelancer/bid_project/close','Freelancer\ProjectDetailOpenController@close');


Route::get('/load-project-list','ProfileController@loadProjectList');
Route::get('/load-bid-list','ProfileController@loadBidList');
Route::get('/load-review-list','ProfileController@loadReviewList');
Route::get('/freelancer/post_project_form/edit/{project_id}','Freelancer\PostProjectController@edit');

Route::post('/freelancer/postproject/update','Freelancer\PostProjectController@update');


Route::post('/freelancer/profile_bid_project/update/','ProfileController@updateBidProject');


Route::get('/edit_bid_project_error','ProfileController@updateBidProjectWithError');







//==================> Freelancer <========================


//==================> Chat <==============================
Route::get('/chat/login','Chat\ChatController@login');
Route::get('/chat/chat-room','Chat\ChatController@chatRoom');
//==================> Freelancer <========================
