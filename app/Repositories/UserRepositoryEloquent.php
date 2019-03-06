<?php declare(strict_types=1);

namespace App\Repositories;

use App\Criteria\OrderbyDescCriteria;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Queue;
use PhpParser\Node\Expr\Cast\Bool_;
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
//        $this->pushCriteria(OrderbyDescCriteria::class);
//        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getUsers($payLoad, array $options = [])
    {
        $payLoadKeys = array_keys($payLoad);
        $whereCondition = [];
        $whereNotIn = [];

        $query = $this;
        if (isset($payLoad['active']) && in_array('active', $payLoadKeys)) {
            $whereCondition['active'] = $payLoad['active'];
        }

        if (isset($payLoad['trashed']) && in_array('trashed', array_keys($payLoad)) && is_bool($payLoad['trashed'])) {
        }

        $query  = $query->findWhere($whereCondition);
        return $query;
    }

    public function getUserListForDataTable(array $payLoad): JsonResponse
    {
        $users = $this->getUsers($payLoad);
        return DataTables::of($users)
            ->addIndexColumn()
            ->escapeColumns(['name', 'email'])
            ->editColumn('status', function ($user) {
                return ($user->active == 1) ? 'Active' : 'Inactive';
            })
            ->editColumn('verify', function ($user) {
                return ($user->verify == 1) ? 'Yes' : 'No';
            })
            ->addColumn('actions', function ($user) {
                return view('users.listaction', compact('user'))->render();
            })
            ->make(true);

    }

    /**
     *
     * @param User $user
     * @return bool
     * @todo
     */
    public function isEditableUser(User $user): bool
    {
        $disAllowedRoles = ['system-admin', 'supper-most-admin'];
        $currentUserRole = $user->getRoleNames()->toArray();
        if (count(array_intersect($disAllowedRoles,$currentUserRole)) >= 1 ) {
            return false;
        }

        return true;
    }
}
