<?php

namespace App\Entities;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Payment.
 *
 * @package namespace App\Entities;
 */
class Payment extends Model implements Transformable
{
    use TransformableTrait, UuidTrait;


    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name_client',
        'cpf',
        'description',
        'amount',
        'payment_status_id',
        'payment_method_slug',
        'merchant_id',
        'fee_amount',
        'percent_tax',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'paid_at'
    ];

    /**
     * Get the payment status associated with the payment.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id', 'id');
    }

    /**
     * Get the payment method associated with the payment.
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_slug', 'slug');
    }

    /**
     * Get the merchant associated with the payment.
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }
}
