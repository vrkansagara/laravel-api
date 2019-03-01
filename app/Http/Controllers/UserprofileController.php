<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Repositories\interfaces\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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

        $validationRules = config('validation_rules.user_profile');
        $validator = JsValidatorFacade::make($validationRules);

        $layoutData = [
            'validator' => $validator,
            'userImageUrl' => Auth::user()->getFirstMedia('avatar')->getFullUrl()
        ];

        return view('users.profile.index', $layoutData);

    }

    public function update(Request $request, $id)
    {

        $validationRules = config('validation_rules.user_profile');

        $validator = Validator::make($request->toArray(),$validationRules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->getMessageBag())->withInput($request->all());
        }
        $user = $this->userRepository->find($id);
        $image = $request->file('image');
        if(null !== $image && $image instanceof  UploadedFile){
            $user->clearMediaCollection('avatar');
            $user->addMedia($image)->toMediaCollection('avatar');
        }

        return redirect()->route('profile.index')->with('message','User profile updated successfully !');

    }
}
