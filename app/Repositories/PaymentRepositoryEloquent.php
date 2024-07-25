<?php

namespace App\Repositories;

use App\Repositories\PaymentRepository;
use App\Entities\Payment;
use App\Presenters\PaymentPresenter;

/**
 * Class PaymentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PaymentRepositoryEloquent extends Repository implements PaymentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Payment::class;
    }

    /**
     * @return string
     */
    public function presenter(): string
    {
        return PaymentPresenter::class;
    }

}
