<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\PaymentCreateRequest;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;

/**
 * Class PaymentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PaymentsController extends Controller
{
    protected $service;

    /**
     * PaymentsController constructor.
     *
     * @param PaymentService $service
     */
    public function __construct(PaymentService $service)
    {
        $this->service = $service;
    }

    /**
     * @param PaymentCreateRequest $request
     *
     * @return JsonResponse
     */
    public function storePayment(PaymentCreateRequest $request): JsonResponse
    {
        try {
            return $this->successCreatedResponse($this->service->storePayment($request->validated()));
        } catch (\Exception $exception) {
            return $this->undefinedErrorResponse($exception);
        }
    }
}
