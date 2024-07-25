<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Payment;

/**
 * Class PaymentTransformer.
 *
 * @package namespace App\Transformers;
 */
class PaymentTransformer extends TransformerAbstract
{
    /**
     * Transform the Payment entity.
     *
     * @param \App\Entities\Payment $model
     *
     * @return array
     */
    public function transform(Payment $model)
    {
        return [
            'id'              => (string) $model->id,
            'name_client'     => $model->name_client,
            'cpf'             => $model->cpf,
            'description'     => $model->description,
            'amount'          => $model->amount,
            'fee_amount'      => $model->fee_amount,
            'percent_tax'     => $model->percent_tax,
            'payment_status'  => $this->transformRelation($model->status, ['id', 'name']),
            'payment_method'  => $this->transformRelation($model->paymentMethod, ['id', 'name', 'slug']),
            'merchant_id'     => $model->merchant_id,
            'created_at'      => $model->created_at,
            'updated_at'      => $model->updated_at,
            'paid_at'         => $model->paid_at,
        ];
    }

    protected function transformRelation($model, array $fields): ?array
    {
        if (!$model) {
            return null;
        }

        return collect($model->toArray())
            ->only($fields)
            ->toArray();
    }
}
