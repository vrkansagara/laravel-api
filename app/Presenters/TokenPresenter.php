<?php

namespace App\Presenters;

use App\Transformers\TokenTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TokenPresenter.
 *
 * @package namespace App\Presenters;
 */
class TokenPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TokenTransformer();
    }
}
