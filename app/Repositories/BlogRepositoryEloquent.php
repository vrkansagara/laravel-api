<?php declare(strict_types=1);

namespace App\Repositories;

use App\Criteria\OrderbyDescCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\Blog\BlogRepository;
use App\Entities\Blog\Blog;
use App\Validators\BlogValidator;

/**
 * Class BlogRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BlogRepositoryEloquent extends BaseRepository implements BlogRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Blog::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return BlogValidator::class;
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
