<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
//        $locale = App::getLocale();
//        dd($locale);

        App::setLocale($locale);

        session()->put('locale', $locale);

        return redirect()->back();

    }
}
