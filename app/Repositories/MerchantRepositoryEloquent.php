<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Merchant;
use App\Presenters\MerchantPresenter;

/**
 * Class MerchantRepositoryEloquent.
 */
class MerchantRepositoryEloquent extends Repository implements MerchantRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model(): string
    {
        return Merchant::class;
    }

    /**
     * @return string
     */
    public function presenter(): string
    {
        return MerchantPresenter::class;
    }
}
