<?php declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Events\User\LoginEvent;
use App\Events\User\LogoutEvent;
use App\Http\Controllers\Controller;
use App\Repositories\interfaces\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | LoginEvent Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    private  $userRepository;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest')->except('logout');

        $this->redirectTo = route('dashboard');

        $this->userRepository = $userRepository;
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = \Auth::user();
            event(new LoginEvent($user));
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $user = \Auth::user();
        event(new LogoutEvent($user));

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('front.home');
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($socialProvider)
    {
        return Socialite::driver($socialProvider)
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($socialProvider)
    {
        $user = Socialite::driver($socialProvider)->user();
        $email  = $user->getEmail();
        
        $isUser = $this->userRepository->findByField('email',$email)->first();

        if($isUser instanceof  User && !in_array($socialProvider,['twitter'])){
            // User found
            \Auth::login($isUser,true);
            return redirect($this->redirectTo);
        }else{
            // Register user and send email.
            return redirect(route('register'));
        }



    }


}
