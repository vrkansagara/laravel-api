<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;

class SampleController extends Controller
{
    private $validationRules = [
        'name' => 'required|min:3|max:80',
        'email' => 'required|email',
        'password' => 'required|min:3|max:80',
        'countries' => 'required|array|min:1',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ];

    public function indexAction()
    {


        $messages = [
            'name.required' => ' Name must be unique.'
        ];

        $validator = JsValidatorFacade::make($this->validationRules, $messages);
        $layoutData = [
            'validator' => $validator
        ];

        return view('sample.index', $layoutData);

    }

    public function submitAction(Request $request)
    {
        $payLoad = $request->except('_token');
        $validation = Validator::make($request->all(), $this->validationRules);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
        }

        dd($payLoad);
    }


    public function samplePageAction()
    {
        return view('sample.page');

    }
}
