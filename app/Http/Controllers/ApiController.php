<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\interfaces\ApiInterface;
use App\Traits\ApiTraits;
use App\Utilities\ApiResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends BaseController implements ApiInterface
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use ApiTraits;

    public function __construct()
    {

    }

    public function response($data)
    {
        return ApiResponse::response($data);

    }
}
