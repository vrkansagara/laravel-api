<?php
/**
 * Created by PhpStorm.
 * User: vallabh
 * Date: 14/11/18
 * Time: 10:04 PM
 */

namespace App\Http\Controllers\Api\interfaces;

use Illuminate\Http\Request;

interface AuthInterface
{
    public function login(Request $request);

    public function logout(Request $request);

    public function register(Request $request);

    public function forgetPassword(Request $request);

    public function resetPassword(Request $request);
}
