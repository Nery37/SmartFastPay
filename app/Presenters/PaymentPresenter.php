<?php

namespace App\Presenters;

use App\Presenters\Trait\PresentTrait;
use App\Transformers\PaymentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PaymentPresenter.
 *
 * @package namespace App\Presenters;
 */
class PaymentPresenter extends FractalPresenter
{
    use PresentTrait;
}
