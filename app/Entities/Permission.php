<?php

namespace App\Entities;

use App\Traits\ModelTraits;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * Class Permission.
 *
 * @package namespace App\Entities;
 */
class Permission extends SpatiePermission implements Transformable
{
    use TransformableTrait;
    use ModelTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'guard_name'
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

}
