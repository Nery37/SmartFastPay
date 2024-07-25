<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Entities\Merchant;
use League\Fractal\TransformerAbstract;

/**
 * Class MerchantTransformer.
 */
class MerchantTransformer extends TransformerAbstract
{
    /**
     * Transform the Merchant entity.
     *
     * @param Merchant $model
     *
     * @return array
     */
    public function transform(Merchant $model): array
    {
        return [
            'id' => $model->id,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString()
        ];
    }
}
