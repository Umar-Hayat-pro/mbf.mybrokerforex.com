<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class Live_DataController extends Controller
{

    public function index(Request $request)
{
    $pageTitle = 'Forex Live Accounts';

    // Fetch and filter data
    $query = DB::connection('mbf-dbmt5')
        ->table('mt5_users')
        ->select('mt5_users.*')
        ->where('mt5_users.Group', 'not like', '%manager%')
        ->where('mt5_users.Group', 'not like', '%demo%');

    // Apply search filter if a search term is provided
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('Login', 'LIKE', "%{$search}%")
              ->orWhere('Name', 'LIKE', "%{$search}%")
              ->orWhere('Group', 'LIKE', "%{$search}%");
        });
    }

    $userData = $query->orderBy('mt5_users.login', 'desc')->get()->toArray();

    // Prepare widget data
    $totalUsers = count($userData);
    $activeAccounts = count(array_filter($userData, fn($account) => $account->Status === 'RE'));
    $inactiveAccounts = count(array_filter($userData, fn($account) => $account->Status ===  ''));
    $totalBalance = number_format(array_sum(array_column($userData, 'Balance')), 2);

    $widget = [
        'total_users' => $totalUsers,
        'active_accounts' => $activeAccounts,
        'inactive_accounts' => $inactiveAccounts,
        'total_balance' => $totalBalance,
    ];

    // Pagination
    $currentPage = $request->input('page', 1);
    $perPage = 25;
    $offset = ($currentPage - 1) * $perPage;

    $accounts = new LengthAwarePaginator(
        array_slice($userData, $offset, $perPage),
        $totalUsers,
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    if ($request->ajax()) {
        return view('admin.forexAccount.liveAccount.index', compact('accounts'))->render();
    }

    return view('admin.forexAccount.liveAccount.index', compact('accounts', 'pageTitle', 'widget'));
}


}
