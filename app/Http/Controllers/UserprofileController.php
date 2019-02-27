<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Repositories\interfaces\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;

class UserprofileController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;

    }

    public function index(Request $request)
    {

//$user =Auth::user();
//        dd($user->getMedia());
        $validationRules = config('validation_rules.user_profile');
        $validator = JsValidatorFacade::make($validationRules);
        if (isset(Auth::user()->media) && null !=  Auth::user()->media->first()){
            $userImage = Auth::user()->media->first()->getFullUrl();
        }else{
            $userImage = '';
        }

        $layoutData = [
//            'validator' => $validator
            'userImageUrl' => $userImage
        ];

        return view('users.profile.index', $layoutData);

    }

    public function update(Request $request, $id)
    {

        $user = $this->userRepository->find($id);
//        $user->clearMediaCollection('avatar');
        $image = $request->file('image');

        $user->addMedia($image)->toMediaCollection('avatar');
        $media = $user->media->first()->getUrl();
        $payLoad = $request->all();

        return redirect()->route('profile.index');

    }
}
