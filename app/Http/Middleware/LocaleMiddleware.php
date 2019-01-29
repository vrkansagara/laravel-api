<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure, Session, Auth;

class LocaleMiddleware
{

    /**
     * The availables languages.
     *
     * @array $languages
     */
    protected $languages = ['en', 'fr'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if (!Session::has('locale')) {
//            Session::put('locale', $request->getPreferredLanguage($this->languages));
//        }
//
//        app()->setLocale(Session::get('locale'));
//
////        if (!Session::has('statut')) {
////            Session::put('statut', Auth::check() ? Auth::user()->role->slug : 'visitor');
////        }
//
//        return $next($request);


        /*
        * Locale is enabled and allowed to be changed
        */
        if (config('locale.status')) {
            if (session()->has('locale') && in_array(session()->get('locale'), array_keys(config('locale.languages')))) {
                /*
                 * Set the Laravel locale
                 */
                app()->setLocale(session()->get('locale'));
                /*
                 * setLocale for php. Enables ->formatLocalized() with localized values for dates
                 */
                setlocale(LC_TIME, config('locale.languages')[session()->get('locale')][1]);
                /*
                 * setLocale to use Carbon source locales. Enables diffForHumans() localized
                 */
                Carbon::setLocale(config('locale.languages')[session()->get('locale')][0]);
                /*
                 * Set the session variable for whether or not the app is using RTL support
                 * for the current language being selected
                 * For use in the blade directive in BladeServiceProvider
                 */
                if (config('locale.languages')[session()->get('locale')][2]) {
                    session(['lang-rtl' => true]);
                } else {
                    session()->forget('lang-rtl');
                }
            }
        }
        return $next($request);

    }

}
