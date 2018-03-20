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

Route::get('/', function () {
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
Route::post('/profile/save_profile','ProfileController@saveProfile');
Route::post('/profile/save_cover','ProfileController@saveCover');





//==================> Freelancer <========================

