<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\ibAccounttypesModal; // Update with the correct model name



class ibAccountController extends Controller
{
    private static function getGroupOptions()
{
    return [
        'MT5 Group' => 'MT5 Group',
        'MT4 Group' => 'MT4 Group',
    ];
}

    private static function getStatusOptions()
    {
        return [
            'Active' => 'Active',
            'Inactive' => 'Inactive',
        ];
    }

    private static function getIbTypeOptions()
    {
        return [
            'IB 1' => 'IB 1',
            'Ib 2' => 'Ib 2',
            'IB 3' => 'IB 3',
        ];
    }


    public function index(Request $request)
    {
        $pageTitle = 'All IB Account Types';
    
        try {
            $accountList = collect(ibAccounttypesModal::all()->toArray()); // Convert to collection
        } catch (QueryException $e) {
            $accountList = collect([]); // Empty collection on error
        }
    
        $perPage = 5; // Number of items per page
        $page = $request->get('page', 1); // Get the current page or default to 1
        $pagedData = $accountList->slice(($page - 1) * $perPage, $perPage)->values(); // Paginate manually
    
        $pagination = new LengthAwarePaginator($pagedData, $accountList->count(), $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
    
        return view('admin.accounttype.IbAccountType.IbAccountindex', compact('pagination', 'pageTitle'));
    }
    
    public function create()
    {
        $pageTitle = 'Add New IB Account Type';
        $groupOptions = self::getGroupOptions();
        $statusOptions = self::getStatusOptions();
        $ibTypeOptions = self::getIbTypeOptions();

        return view('admin.accounttype.IbAccountType.edit', compact('pageTitle', 'groupOptions', 'statusOptions', 'ibTypeOptions'));
    }

    public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'group' => 'required|string|max:255',
        'badge' => 'nullable|string|max:255',
        'status' => 'required|string|in:Active,Inactive', // Adjust based on your status options
        'type' => 'required|string|max:255',
    ]);

    // Create a new instance of the model
    $newAccount = new ibAccountTypesModal($validatedData);

    // Save the new account type to the database
    $newAccount->save();
    $notify[]=['success','Account type created successfully'];

    // Redirect to the index route with a success message
    return redirect()->route('admin.ibaccounttype.index')->withNotify($notify);
}


    public function edit($id)
{
    $accountData = ibAccounttypesModal::findOrFail($id);
    $pageTitle = 'Edit IB Account Type';
    $groupOptions = self::getGroupOptions();
    $statusOptions = self::getStatusOptions();
    $ibTypeOptions = self::getIbTypeOptions();

    return view('admin.accounttype.IbAccountType.edit', compact('pageTitle', 'accountData', 'id', 'groupOptions', 'statusOptions', 'ibTypeOptions'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'group' => 'required|string|max:255',
        'badge' => 'required|string|max:255',
        'status' => 'required|string',
        'type' => 'required|string',
    ]);

    $accountData = ibAccounttypesModal::findOrFail($id);
    $accountData->update($request->only(['title', 'group', 'badge', 'status', 'type']));
    $notify[] = ['success','IB Account type updated successfully'];

    return redirect()->route('admin.ibaccounttype.index')->withNotify($notify);
}

public function destroy($id)
{
    $accountData = ibAccounttypesModal::findOrFail($id);
    $accountData->delete();

    return redirect()->route('admin.ibaccounttype.index')->with('success', 'IB Account Type deleted successfully.');
}
}
