<?php

namespace App\Entities;

use App\Traits\ModelTraits;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Tylercd100\LERN\Models\ExceptionModel;

/**
 * Class Error.
 *
 * @package namespace App\Entities;
 */
class Error extends ExceptionModel implements Transformable
{
    use TransformableTrait;
    use ModelTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
