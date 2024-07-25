<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\PaymentStatusEnum;
use App\Repositories\PaymentRepository;
use App\Repositories\PaymentMethodRepository;
use App\Wrappers\Interfaces\PaymentGatewayInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * PaymentService.
 */
class PaymentService extends AppService
{
    protected RepositoryInterface $repository;
    private $paymentMethodRepository;

    /**
     * @param PaymentRepository $repository
     * @param PaymentMethodRepository $paymentMethodRepository
     * @param PaymentGatewayInterface $paymentGateway
     */
    public function __construct(
        PaymentRepository $repository,
        PaymentMethodRepository $paymentMethodRepository,
        private readonly PaymentGatewayInterface $paymentGateway

    ) {
        $this->repository = $repository;
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * @param int  $limit
     * @param bool $paginate
     *
     * @return mixed
     *
     * @throws RepositoryException
     */
    public function all(int $limit = 15, bool $paginate = true, string $sortBy = 'id', string $sortDir = 'asc'): mixed
    {
        $queryBuilder = $this->repository
            ->resetCriteria()
            ->pushCriteria(app(RequestCriteria::class));

        if (!empty($sortBy) && in_array(strtolower($sortDir), ['asc', 'desc'])) {
            $queryBuilder->orderBy($sortBy, $sortDir);
        }

        if ($paginate) {
            return $queryBuilder->paginate($limit);
        }
        return $queryBuilder->all();
    }


    public function storePayment(array $data): mixed
    {
        try {
            DB::beginTransaction();

            // Recuperando identificação do merchant logado.
            $data['merchant_id'] = Auth::user()->id;

            // Recuperando taxa atual referente ao método de pagamento escolhido.
            $paymentMethod = $this->paymentMethodRepository->skipPresenter(false)->where(['slug' => $data['payment_method_slug']])->first();

            // Calculando valores
            $treatedValue = $this->calculateNetAmount((float)$data['amount'], (float)$paymentMethod->fee);
            $data['fee_amount'] = $treatedValue['fee_amount'];
            $data['percent_tax'] = (float)$paymentMethod->fee;

            // Criando pagamento
            $payment = $this->create($data, true);

            // Simulando chamada para provider
            $result = $this->paymentGateway->process();

            // Alterando saldo do merchant e demais propriedades do pagamento com base no retorno do provider
            if ($result) {
                $this->updateMerchantBalance($treatedValue['net_amount']);
                $payment->payment_status_id = PaymentStatusEnum::PAID->value;
                $payment->paid_at = now();
            } else {
                $payment->payment_status_id = PaymentStatusEnum::FAILED->value;
            }

            // Finalizando processo.
            $payment->save();

            DB::commit();
            return $this->repository->skipPresenter(false)->find($payment->id);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function calculateNetAmount(float $amount, float $fee): array
    {
        $feePercentage = $fee ?? 0;
        $feeAmount = ($amount * $feePercentage) / 100;
        $netAmount = $amount - $feeAmount;

        return [
            'net_amount' => $netAmount,
            'fee_amount' => $feeAmount
        ];
    }

    private function updateMerchantBalance(float $amount): void
    {
        $merchant = Auth::user();
        $merchant->balance += $amount;
        $merchant->save();
    }
}
