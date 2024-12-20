<?php


namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',
            'firstname',
            'lastname',
            'username',
            'email',
            'country_code',
            'mobile',
            'ref_by',
            'address',
            'status',
            'kyc_data',
            'kv',
            'ev',
            'sv',
            'profile_complete',
            'ver_code',
            'ver_code_send_at',
            'ts',
            'tv',
            'tsc',
            'ban_reason',
            'provider',
            'image',
            'remember_token',
            'metamask_wallet_address',
            'metamask_nonce',
            'created_at',
            'updated_at'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
  
    public function collection()
    {
        return User::all()->map(function ($user) {
            return [
                'id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'username' => $user->username,
                'email' => $user->email,
                'country_code' => $user->country_code,
                'mobile' => $user->mobile,
                'ref_by' => $user->ref_by,
                'address' => json_encode($user->address), // Convert address to JSON string
                'status' => $user->status,
                'kyc_data' => $user->kyc_data,
                'kv'=> $user->kv,
                'ev'=> $user->ev,
                'sv'=> $user->sv,
                'profile_complete'=> $user->profile_complete,
                'ver_code'=> $user->ver_code,
                'ver_code_send_at'=> $user->ver_code_send_at,
                'ts'=> $user->ts,
                'tv'=> $user->tv,
                'tsc'=> $user->tsc,
                'ban_reason'=> $user->ban_reason,
                'provider'=> $user->provider,
                'image'=> $user->image,
                'remember_token'=> $user->remember_token,
                'metamask_wallet_address'=> $user->metamask_wallet_address,
                'metamask_nonce'=> $user->metamask_nonce,
                'created_at'=> $user->created_at,
                'updated_at'=> $user->updated_at
            ];
        });
    }
    

}


