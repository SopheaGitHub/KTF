<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use URL;

class RegisterController extends Controller
{
    protected $data = null;
    private  $users,$date,$limit = 5;

    public function __construct(){
        $this->data = new \stdClass();
        $this->users = new Users();
        $this->date = date ("Y-m-d H:i:s");
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* URL */
        $this->data->url_store = URL::to('freelancer/register/store');
        /*END URL */

        return  view('freelancer.register', ['data'=>$this->data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postDataUser = [
            'user_firstname'        => $request->txtFirstName,
            'user_lastname'         => $request->txtLastName,
            'user_phoneno'          => $request->txtPhoneNoOrMail,
            'user_email'            => $request->txtPhoneNoOrMail,
            'user_password'         => $request->txtPassword,
            'created_at'            => $this->date,
            'updated_at'            => $this->date
        ];

        $user = $this->users->insertUsers($postDataUser);
        $request->session()->flash('message','Intert Success!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
