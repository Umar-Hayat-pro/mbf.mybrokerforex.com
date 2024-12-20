<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    
    public function export() 
    {
        return Excel::download(new TransactionsExport, 'transactions.xlsx');
    }
}