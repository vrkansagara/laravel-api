<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BootstrapController extends Controller
{
    public function modalBox()
    {
        return view('bootstrap.modal');
    }
}
