<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',
            'user_id',
            'amount',
            'charge',
            'post_balance',
            'trx_type',
            'trx',
            'details',
            'remark',
            'wallet_id',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaction::all()->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'user_id' => $transaction->user_id,
                'amount' => $transaction->amount,
                'charge' => $transaction->charge,
                'post_balance' => $transaction->post_balance,
                'trx_type' => $transaction->trx_type,
                'trx' => $transaction->trx,
                'details' => $transaction->details,
                'remark' => $transaction->remark,
                'wallet_id' => $transaction->wallet_id,
                'created_at' => $transaction->created_at,
                'updated_at' => $transaction->updated_at,
            ];
        });
    }
}
