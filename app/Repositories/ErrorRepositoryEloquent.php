<?php

namespace App\Repositories;

use App\Criteria\OrderbyDescCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\ErrorRepository;
use App\Entities\Error;
use App\Validators\ErrorValidator;

/**
 * Class ErrorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ErrorRepositoryEloquent extends BaseRepository implements ErrorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Error::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ErrorValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(OrderbyDescCriteria::class);
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
