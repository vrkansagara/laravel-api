<?php
/**
 * Created by PhpStorm.
 * User: vallabh
 * Date: 18/11/18
 * Time: 11:18 AM
 */

namespace App\Http\Controllers\Api\Blog\Interfaces;


use Illuminate\Http\Request;

interface CategoryInterface
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
