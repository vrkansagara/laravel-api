<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Token;

/**
 * Class TokenTransformer.
 *
 * @package namespace App\Transformers;
 */
class TokenTransformer extends TransformerAbstract
{
    /**
     * Transform the Token entity.
     *
     * @param \App\Entities\Token $model
     *
     * @return array
     */
    public function transform(Token $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
