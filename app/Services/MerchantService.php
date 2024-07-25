<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\MerchantRepository;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * MerchantService.
 */
class MerchantService extends AppService
{
    protected RepositoryInterface $repository;

    /**
     * @param MerchantRepository $repository
     */
    public function __construct(
        MerchantRepository $repository,
    ) {
        $this->repository = $repository;
    }
}
