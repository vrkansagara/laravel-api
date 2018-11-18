<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Blog\BlogInterface;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class BlogController extends ApiController implements BlogInterface
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        // TODO: Implement index() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // TODO: Implement show() method.
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    /**
     * @return mixed
     */
    public function destroyAll()
    {
        // TODO: Implement destroyAll() method.
    }
}
