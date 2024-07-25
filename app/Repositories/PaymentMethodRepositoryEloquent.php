<?php

namespace App\Repositories;

use App\Repositories\PaymentRepository;
use App\Entities\Payment;
use App\Entities\PaymentMethod;
use App\Presenters\PaymentPresenter;

/**
 * Class PaymentMethodRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PaymentMethodRepositoryEloquent extends Repository implements PaymentMethodRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PaymentMethod::class;
    }

}
