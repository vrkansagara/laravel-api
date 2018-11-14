<?php
/**
 * Created by PhpStorm.
 * User: vallabh
 * Date: 14/11/18
 * Time: 10:04 PM
 */

namespace App\Http\Controllers\Api\interfaces;


interface AuthInterface
{
    public function login();

    public function logout();

    public function register();

    public function forgetPassword();

    public function resetPassword();

}
