<?php

namespace App\Repositories\Acl\Role;

use App\Criteria\OrderbyDescCriteria;
use App\Entities\Acl\Role\Role;
use App\Repositories\interfaces\Acl\Role\RoleRepositoryInterface;
use App\Validators\RoleValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class RoleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return RoleValidator::class;
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


    public function getRoleListForDataTable(array $payLoad)
    {
        $users = $this->all();
        return DataTables::of($users)
            ->escapeColumns(['name', 'email'])
            ->editColumn('status', function ($user) {
                return ( $user->active === 1 ) ? 'Active' : 'Inactive';
            })
            ->editColumn('verify', function ($user) {
                return ( $user->verify=== 1 ) ? 'Yes' : 'No';
            })
            ->addColumn('actions', function ($user) {
                return view('users.listaction',compact('user'))->render();
            })
            ->make(true);

    }
}
