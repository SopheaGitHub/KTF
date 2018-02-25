<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/freelancer/success';




    protected $data = null;


    public function __construct(){
        $this->data = new \stdClass();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $rules = [];
        $messages = [];

        $rules = [
            'user_firstname' => 'required|string|max:255',
            'user_lastname' => 'required|string|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|min:6|same:password',      
            ];

          $messages = [
            'user_firstname.required' => trans('auth.field_required'),
            'user_firstname.max' => trans('auth.field_max_255'),
            'user_lastname.required' => trans('auth.field_required'),
            'user_lastname.max' => trans('auth.field__max_255'),
            'email.required' => trans('auth.field_required'),
            'email.string' => trans('auth.field_string'),
            'email.unique' => trans('auth.email_unique'),
            'password.required' => trans('auth.password_required'),
            'password.string' => trans('auth.password_string'),
            'password.min' => trans('auth.password_min_6'),
            'password_confirmation.required' => trans('auth.password_confirmation_required'),
            'password_confirmation.min' => trans('auth.password_confirmation_min_6'),
            'password_confirmation.same' => trans('auth.password_confirmation_same'),
            'accept_policy' => trans('auth.accept_policy'),
        ];

        if (!is_numeric($data['email'])) {
            $rules['email'] = 'required|min:3|max:25|email';
            $messages['email.required'] = trans('auth.field_required');
            $messages['email.min'] = trans('auth.mail_min_4');
            $messages['email.max'] = trans('auth.mail_max_20');
            $messages['email.email'] = trans('auth.mail_invalid');
        }else if(is_numeric($data['email'])){
            $rules['email'] = 'required|min:9|max:10';
            $messages['email.required'] = trans('auth.field_required');
            $messages['email.min'] = trans('auth.phone_min_9');
            $messages['email.max'] = trans('auth.phone_max_10');
             if(is_numeric(substr($data['email'], 0,1))!= 0){
               // $rules['email'] = 'invalid'
                $messages['email.invalid'] = trans('auth.phone_invalid');
             }
        }else {
            $rules['email'] = 'invalid';
            $messages['email.invalid'] = trans('auth.field_invalid');
         }

         if(!isset($data['accept_policy'])){
            $rules['accept_policy'] = 'required';
            $messages['accept_policy.required'] = trans('auth.accept_policy');
         }
        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
         $phoneno ="";
         $email = "";

        if(is_numeric($data['email'])){
             $phoneno  = $data['email'];
        }else{
             $email     = $data['email'];
        }

        return User::create([
            'user_firstname' => $data['user_firstname'],
            'user_lastname' => $data['user_lastname'],
            'username' => $data['email'],
            'email' => $email,
            'user_phoneno' =>  $phoneno,
            'password' => bcrypt($data['password']),
        ]);
    }



    protected function success(){
        $this->data->title = 'Message';
        $this->data->message = 'Congratulation your registration was successfully.';
        return  view('freelancer.success', ['data'=>$this->data]);
    }


}
