<?php

namespace Princetech\MobileMoney\Mpesa\Database\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Princetech\MobileMoney\Mpesa\Database\Entities\MpesaStkRequest
 *
 * @property int $id
 * @property string $phone
 * @property float $amount
 * @property string $reference
 * @property string $description
 * @property string $status
 * @property int $complete
 * @property string $MerchantRequestID
 * @property string $CheckoutRequestID
 * @property int|null $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Princetech\MobileMoney\Mpesa\Database\Entities\MpesaStkCallback $response
 * @mixin \Eloquent
 */
class MpesaStkRequest extends Model
{
    protected $guarded = [];

    public function response()
    {
        return $this->hasOne(MpesaStkCallback::class, 'CheckoutRequestID', 'CheckoutRequestID');
    }
}
