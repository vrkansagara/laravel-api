<?php declare(strict_types=1);

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\TokenRepository;
use App\Entities\Token;
use App\Validators\TokenValidator;

/**
 * Class TokenRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TokenRepositoryEloquent extends BaseRepository implements TokenRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Token::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TokenValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
