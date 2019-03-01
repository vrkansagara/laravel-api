<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Entities\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected static function getCurrentPolicyClass($className, array $arguments = [])
    {

        $classModelMapping = [
            UsersController::class => User::class
        ];

        if (in_array($className, $classModelMapping)) {
            return $classModelMapping[$className];
        }
    }
}
