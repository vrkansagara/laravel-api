<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Blog\Blog;

/**
 * Class BlogTransformer.
 *
 * @package namespace App\Transformers;
 */
class BlogTransformer extends TransformerAbstract
{
    /**
     * Transform the Blog entity.
     *
     * @param \App\Entities\Blog\Blog $model
     *
     * @return array
     */
    public function transform(Blog $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
