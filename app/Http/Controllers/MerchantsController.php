<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\MerchantService;

/**
 * Class MerchantsController.
 */
class MerchantsController extends Controller
{
    protected $service;

    /**
     * @param MerchantService $service
     */
    public function __construct(MerchantService $service)
    {
        $this->service = $service;
    }
}
