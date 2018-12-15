<?php

namespace App\Presenters;

use App\Transformers\ErrorTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ErrorPresenter.
 *
 * @package namespace App\Presenters;
 */
class ErrorPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ErrorTransformer();
    }
}
