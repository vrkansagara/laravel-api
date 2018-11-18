<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController  extends ApiController implements CategoryInterface
{
    public function index(Request $request)
    {
        // TODO: Implement index() method.
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function destroyAll()
    {
        // TODO: Implement destroyAll() method.
    }

}
