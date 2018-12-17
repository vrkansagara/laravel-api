<?php

namespace App\Entities;

use App\Traits\ModelTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Class Role.
 *
 * @package namespace App\Entities;
 */
class Role extends SpatieRole implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use ModelTraits;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','display_name','guard_name'
    ];

}
