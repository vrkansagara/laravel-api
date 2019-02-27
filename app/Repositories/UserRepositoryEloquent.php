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

    public function getUsers($payLoad, array $options = [])
    {
        $payLoadKeys = array_keys($payLoad);
        $whereCondition = [];
        $whereNotIn = [];

        if (isset($payLoad['active']) && in_array('active', $payLoadKeys)) {
            $whereCondition['active'] = $payLoad['active'];
        }

        if (isset($payLoad['trashed']) && in_array('trashed', array_keys($payLoad)) && is_bool($payLoad['trashed'])) {
        }


//        if (in_array('supper-admin', \Auth::user()->getRoleNames())) {
//            $this->findWhereNotIn([]);
//        } else {
//            $this->findWhereNotIn($whereNotIn);
//        }

        $query = $this->findWhere($whereCondition);

        return $query;
    }

    public function getUserListForDataTable(array $payLoad)
    {
        $users = $this->getUsers($payLoad);
        return DataTables::of($users)
            ->escapeColumns(['name', 'email'])
            ->editColumn('status', function ($user) {
                return ($user->active === 1) ? 'Active' : 'Inactive';
            })
            ->editColumn('verify', function ($user) {
                return ($user->verify === 1) ? 'Yes' : 'No';
            })
            ->addColumn('actions', function ($user) {
                return view('users.listaction', compact('user'))->render();
            })
            ->make(true);

    }
}
