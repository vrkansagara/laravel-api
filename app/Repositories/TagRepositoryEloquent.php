<?php declare(strict_types=1);

namespace App\Repositories;

use App\Criteria\OrderbyDescCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\Blog\TagRepository;
use App\Entities\Blog\Tag;
use App\Validators\TagValidator;

/**
 * Class TagRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TagRepositoryEloquent extends BaseRepository implements TagRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TagValidator::class;
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
