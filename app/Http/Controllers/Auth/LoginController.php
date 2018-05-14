<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();

        // $user->token;
        
        $findUser = User::where('email', $userSocial->email)->first();
        if($findUser) {
            Auth::login($findUser);
            return 'Done with old data';
        }else {
            $user = new User();
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt(123456);
            $user->save();

            Auth::login($user);
            return 'Done with new data';
        }

    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToProvider2()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback2()
    {
        $userSocial = Socialite::driver('google')->stateless()->user();

        // $user->token;
        
        $findUser = User::where('email', $userSocial->email)->first();
        if($findUser) {
            Auth::login($findUser);
            return 'Done with old data';
        }else {
            $user = new User();
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt(123456);
            $user->save();

            Auth::login($user);
            return 'Done with new data';
        }

    }
}
