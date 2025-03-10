<?php

namespace App\Models;

use App\Traits\ApiQuery;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Transaction extends Model
{
    use Searchable, ApiQuery;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function amountWithoutCharge(): Attribute
    {
        return new Attribute(
            get: fn() => $this->amount - $this->charge
        );
    }

    public function accessCombineValue()
    {
        return [
            'wallet' => [Wallet::class, 'combineValue']
        ];
    }
    // Get User Transactions 
    public static function getUserTransactions($userId)
    {
        return self::with('wallet.currency', 'user')
            ->where('user_id', $userId)
            ->searchable(['trx', 'user:username'])
            ->filter(['trx_type', 'remark', 'wallet.currency:symbol'])
            ->dateFilter()
            ->orderBy('id', 'desc')
            ->paginate(getPaginate());
    }

}
