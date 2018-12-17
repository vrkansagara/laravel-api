<?php

namespace App\Entities;

use App\Traits\ModelTraits;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Token.
 *
 * @package namespace App\Entities;
 */
class Token extends Model implements Transformable
{
    use TransformableTrait;
    use ModelTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
