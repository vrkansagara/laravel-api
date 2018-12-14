<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Permission;

/**
 * Class PermissionTransformer.
 *
 * @package namespace App\Transformers;
 */
class PermissionTransformer extends TransformerAbstract
{
    /**
     * Transform the Permission entity.
     *
     * @param \App\Entities\Permission $model
     *
     * @return array
     */
    public function transform(Permission $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
