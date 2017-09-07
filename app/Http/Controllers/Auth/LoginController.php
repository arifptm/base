<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Laravel\Socialite\Facades\Socialite;
use Bouncer;
use File;
use Auth;

use App\User;
use App\UserProfile;
use App\SocialLogin;
use App\Exceptions\SocialAuthException;

use App\Jobs\SendUserVerificationEmail;

use App\Notifications\NewUser;

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
    protected $redirectTo = '/home';

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
     * Sosialite  select provider (arif).
     *
     * @return void
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    } 

    public function handleProviderCallback($provider)
    {
        try {
            $socialUserInfo = Socialite::driver($provider)->user();
            $user = User::whereEmail($socialUserInfo->getEmail())->first();
            if(count($user) == 0 ){
                $user = new User;
                $user->email = $socialUserInfo->getEmail();
                $user->name = $socialUserInfo->getName();
                $user->password = bcrypt(str_random(7));
                $user->verification_token = base64_encode($socialUserInfo->getEmail());    
                $user->save();
                Bouncer::assign('user')->to($user);

                $filename = time().".jpg";
                $fileContents = file_get_contents($socialUserInfo->getAvatar());
                File::put(public_path() . '/assets/profiles/' . $filename , $fileContents);
                $profile = new UserProfile;
                $profile->image = $filename;
                $user->userProfile()->save($profile);
                $admin = User::whereEmail('arifptm@gmail.com')->first();
                $admin->notify(new NewUser($user));

                dispatch(new SendUserVerificationEmail($user));
            } 
            
            
            $provider = "{$provider}_id";
            $social = $user->socialLogin ?: new SocialLogin;
            $social->{$provider} = $socialUserInfo->getId();
            $user->socialLogin()->save($social);                

            if($user->verified == 0){
                dispatch(new SendUserVerificationEmail($user));
                return view('auth.user_confirmation_sent');  
            } else {            
                Auth()->login($user);
                return redirect('/');
            }
           
        } catch (Exception $e) {
            throw new SocialAuthException("failed to authenticate with $provider");
        }
    }
}
