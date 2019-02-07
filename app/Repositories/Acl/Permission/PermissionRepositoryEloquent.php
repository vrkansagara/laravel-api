<?php

namespace App\Repositories\Acl\Permission;

use App\Criteria\OrderbyDescCriteria;
use App\Entities\Acl\Permission\Permission;
use App\Repositories\interfaces\Acl\Permission\PermissionRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Validators\PermissionValidator;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class PermissionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PermissionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(OrderbyDescCriteria::class);
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function delete($id)
    {

        $restrictedIds = [1];
        if (in_array($id, $restrictedIds)) {
            return false;
        }
        return parent::delete($id);
    }

    public function getPermissionListForDataTable(array $payLoad)
    {
        $roles = $this->all();
        return DataTables::of($roles)
            ->escapeColumns(['name'])
            ->addColumn('actions', function ($permission) {
                return view('permissions.listaction',compact('permission'))->render();
            })
            ->make(true);

    }
    
}
