<?php
/**
 * Created by PhpStorm.
 * User: vallabh
 * Date: 18/11/18
 * Time: 11:17 AM
 */

namespace App\Http\Controllers\Api\Blog;


use Illuminate\Http\Request;

interface BlogInterface
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request);

    /**
     * @param $id
     * @return mixed
     */
    public function show($id);

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request);

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * @return mixed
     */
    public function destroyAll();
}
