<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Error;

/**
 * Class ErrorTransformer.
 *
 * @package namespace App\Transformers;
 */
class ErrorTransformer extends TransformerAbstract
{
    /**
     * Transform the Error entity.
     *
     * @param \App\Entities\Error $model
     *
     * @return array
     */
    public function transform(Error $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
