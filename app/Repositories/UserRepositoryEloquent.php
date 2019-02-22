<?php

namespace App\Repositories;

use App\Criteria\OrderbyDescCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\UserRepository;
use App\Entities\User;
use App\Validators\UserValidator;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{

    protected $fieldSearchable = [
        'name' => 'like',
        'email'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return UserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(OrderbyDescCriteria::class);
//        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getUserListForDataTable( array  $payLoad)
    {
        $users = $this->findByField('name','name');
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
