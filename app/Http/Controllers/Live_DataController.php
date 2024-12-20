<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\MT5Accounts;
use Illuminate\Support\Facades\DB;

class Live_DataController extends Controller
{

    public function index(Request $request)
    {

        $pageTitle = 'Forex Live Accounts';

        $userData = DB::table('mt5_users')
            ->join('mt5_accounts', 'mt5_users.login', '=', 'mt5_accounts.login')
            ->select('mt5_users.*', 'mt5_accounts.*')
            ->get()->toArray();


        // Prepare widget data
        $totalUsers = count($userData);
        $activeAccounts = count(array_filter($userData, fn($account) => $account->Status === '1'));
        $inactiveAccounts = count(array_filter($userData, fn($account) => $account->Status === '0' || empty ($account->Status == '')));
        $totalBalance = number_format(array_sum(array_column($userData, 'Balance')), 2);


        $widget = [
            'total_users' => $totalUsers,
            'active_accounts' => $activeAccounts,
            'inactive_accounts' => $inactiveAccounts,
            'total_balance' => $totalBalance,
        ];

        // Get current page from the request, default is 1
        $currentPage = $request->input('page', 1);
        $perPage = 10; // Number of items per page
        $offset = ($currentPage - 1) * $perPage;

        // Paginate the accounts
        $accounts = new LengthAwarePaginator(
            array_slice($userData, $offset, $perPage), // Paginate the accounts array
            $totalUsers, // Total number of items
            $perPage, // Items per page
            $currentPage, // Current page number
            ['path' => $request->url(), 'query' => $request->query()] // Preserve query parameters
        );

        return view('admin.forexAccount.liveAccount.index', compact('accounts', 'pageTitle', 'widget'));
    }




}
