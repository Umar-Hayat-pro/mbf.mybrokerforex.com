<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AccountService
{
    public function __construct()
    {
        // You can Also inject db connection if needed 
        $this->connection = DB::connection('mbf-dbmt5');
    }

    /**
     * Get All Mt5 Accounts of a user by email 
     */

    public function getUserAccounts($email)
    {
        return $this->connection
            ->table('mt5_users')
            ->where('Email', $email)
            ->get();
    }

    /**
     * Get IB Accounts of a user by email
     */

    public function getIBAccounts($email)
    {
        return $this->connection
            ->table('mt5_users')
            ->where('Email', $email)
            ->where('Group', 'Like', '%Multi-IB%')
            ->get();
    }
}