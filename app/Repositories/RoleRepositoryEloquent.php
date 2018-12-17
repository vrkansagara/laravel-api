<?php

namespace App\Repositories;

use App\Criteria\OrderbyDescCriteria;
use App\Entities\Role;
use App\Repositories\interfaces\RoleRepository;
use App\Validators\RoleValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RoleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
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


}
