<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\FormIb;
use Illuminate\Support\Facades\Auth;


class IbDataController extends Controller
{



    protected function paginateArray(array $data, Request $request, $perPage = 25)
    {
        $page = $request->get('page', 1);
        $collection = collect($data);
        $pagedData = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $collection->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

    }

    public function allAccounts(Request $request)
    {
        try {
            $allUser = User::orderBy('created_at', 'desc')->get()->toArray();

        } catch (QueryException $e) {
            $allUser = [];
        }

        $pageTitle = 'All Account Logs';
        $paginator = $this->paginateArray($allUser, $request);

        return view('admin.becomeIB.all', compact('paginator', 'pageTitle'));
    }



    public function pendingAccountsByStatus(Request $request)
    {
        try {
            // Retrieve pending accounts ordered by created_at
            $pendingAccounts = User::where('partner', 2)
                ->where('kv', 1)
                ->orderBy('created_at', 'desc')
                ->get()
                ->toArray();

        } catch (QueryException $e) {
            $pendingAccounts = [];
        }

        $pageTitle = 'Pending Accounts';
        $paginator = $this->paginateArray($pendingAccounts, $request);

        return view('admin.becomeIB.pending', compact('paginator', 'pageTitle'));
    }

    public function activeAccountsByIbStatus(Request $request)
    {
        try {
            $activeAccounts = User::where('partner', 1)->orderBy('created_at', 'desc')->get()->toArray();
        } catch (QueryException $e) {
            $activeAccounts = [];
        }

        $pageTitle = 'All Approved IB';
        $paginator = $this->paginateArray($activeAccounts, $request);

        return view('admin.becomeIB.approved', compact('paginator', 'pageTitle'));
        //Working fine now dont change anything to make it complicated
    }

    public function rejectedAccountsByStatus(Request $request)
    {
        try {
            $rejectedAccounts = User::where('partner', 3)->orderBy('created_at', 'desc')->get()->toArray();
        } catch (QueryException $e) {
            $rejectedAccounts = [];
        }
        $pageTitle = 'Rejected Accounts';
        $paginator = $this->paginateArray($rejectedAccounts, $request);

        return view('admin.becomeIB.rejected', compact('paginator', 'pageTitle'));
    }


    private static function getBrokerBackground()
    {
        return [
            'Copy Trader' => 'Copy Trader',
            'Crypto Trader' => 'Crypto Trader',
            'Forex Trader' => 'Forex Trader',
            'Stock Trader' => 'Stock Trader',
            'Non Trader' => 'Non Trader',
            'Investment Bankers' => 'Investment Bankers'
        ];
    }

    private static function getSelectableOptions()
    {
        return [
            'Copy Trading' => 'Copy Trading',
            'EA Provider' => 'EA Provider',
            'Education' => 'Education',
            'Investment/Trading Advice' => 'Investment/Trading Advice',
            'Signal Services' => 'Signal Services',
            'Social Media Influencing' => 'Social Media Influencing',
            'Training Institute' => 'Training Institute'
        ];
    }


    private static function getCountryOptions()
    {
        return [
            'Malaysia' => 'Malaysia',
            'China' => 'China',
            'Indonesia' => 'Indonesia',
            'Singapore' => 'Singapore',
            'Pakistan' => 'Pakistan',
            'India' => 'India',
            'United Arab Emirates' => 'United Arab Emirates',
            'Other' => 'Other',
        ];
    }







    public function listForms(Request $request)
    {
        $pageTitle = 'Submitted Forms';

        try {
            // Retrieve all forms where ib_status is 1, 2, or 3, ordered by created_at in descending order
            $formList = FormIb::whereIn('partner', [1, 2, 3])
                ->orderBy('created_at', 'desc')
                ->get()
                ->toArray();
        } catch (QueryException $e) {
            $formList = [];
        }

        $paginator = $this->paginateArray($formList, $request);

        return view('admin.becomeIB.list', compact('paginator', 'pageTitle'));
    }



    public function formForUser()
    {
        $pageTitle = 'Become IB User Form';
        $countryOptions = self::getCountryOptions();
        $brokerBackground = self::getBrokerBackground();
        $selectableOptions = self::getSelectableOptions();

        return view('templates.basic.user.becomeIB.form', compact('countryOptions', 'brokerBackground', 'selectableOptions', 'pageTitle'));
    }



    public function create()
    {
        $pageTitle = 'Become An Introducing Broker';
        $countryOptions = self::getCountryOptions(); // Assume this method gets the country options
        $selectableOptions = self::getSelectableOptions(); // Assume this method gets the selectable options
        $brokerBackground = self::getBrokerBackgroundOptions(); // Assume this method gets background options

        return view('admin.becomeIB.create', compact('pageTitle', 'countryOptions', 'selectableOptions', 'brokerBackground'));
    }

    public function storeUserForm(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'country' => 'required|string',
            'expected_clients' => 'required|integer',
            'services' => 'required|string',
            'trading_volume' => 'required|integer',
            'active_clients' => 'required|integer',
            'background_options' => 'required|array',
            'selectable_options' => 'required|array',
            'terms_agreement' => 'required|boolean',
        ]);

        $user = auth()->user();

        // Prepare the data for saving
        $newData = [
            'user_id' => $user->id,
            'username' => $user->firstname . ' ' . $user->lastname,
            'email' => $user->email,
            'user_country' => $user->country_code,
            'country' => $request->input('country'),
            'expected_clients' => $request->input('expected_clients'),
            'services' => $request->input('services'),
            'trading_volume' => $request->input('trading_volume'),
            'active_clients' => $request->input('active_clients'),
            'background_options' => json_encode($request->input('background_options')),
            'selectable_options' => json_encode($request->input('selectable_options')),
            'terms_agreement' => $request->input('terms_agreement'),
            'partner' => 2, // Set partner to 2 for the form data
        ];

        // Save the form data to the database
        FormIb::create($newData);

        // Update the user's partner field to 2
        $user->partner = 2;
        $user->save();

        // Prepare the notification
        $notify[] = ['success', 'Form Submitted Successfully'];

        // Redirect the user with a notification
        return redirect()->route('user.home')->withNotify($notify);
    }





    public function showFormData($id)
    {
        $pageTitle = 'Form Data';

        $formData = optional(FormIb::where('user_id', $id)->first());

        if (!$formData) {
            $notify[] = ['error', 'Form Data not Found'];
            return redirect()->route('admin.form_ib')->withNotify($notify);
        }

        $user = User::where('id', $id)->first();

        // dd($user);
        return view('admin.becomeIB.dataView', compact('formData', 'pageTitle', 'id'));
    }


    public function update(Request $request, $id)
    {
        // Find the form data by user_id
        $form = FormIb::where('user_id', $id)->first();
        // Check if the form exists
        if (!$form) {
            $notify[] = ['error', 'Form Not Found'];
            return redirect()->route('admin.form_ib')->withNotify($notify);
        }

        // Find the user by the user_id stored in the FormIb record
        $user = User::where('id', $id)->first();

        // Check if the user exists
        if (!$user) {
            $notify[] = ['error', 'User Not Found'];
            return redirect()->route('admin.form_ib');
        }

        // Validate the input, specifically the ib_status
        $request->validate([
            'partner' => 'in:1,2', // Ensure ib_status is one of the valid values
        ]);

        // Update the ib_status based on the input
        $form->partner = $request->input('ib_status');
        // Find the associated User and update ib_status
        $user->partner = $request->input('ib_status');
        // Save the updated form and user data
        $user->save();
        $form->save();

        notify($user, 'Data_UPDATED', []);
        $notify[] = ['success', 'User Data Updated Successfully'];


        // Redirect back with success notification
        return redirect()->route('admin.form_ib')->withNotify($notify);
    }



    // public function destroyByUserId($id)
    // {
    //     // Attempt to delete the record with the given user_id
    //     $deletedRows = DB::table('formsIb')->where('user_id', $id)->delete();

    //     if ($deletedRows > 0) {
    //         Toastr::success('success, Form deleted successfully');
    //         return redirect()->route('admin.form_ib');
    //     }
    //      $notify[] = ['error','Form Not Found'];
    //     return redirect()->route('admin.form_ib')->withNotify($notify);
    // }


    public function checkKyc()
    {
        $user = Auth::user();

        if ($user->kv == 1) {
            return redirect()->route('user.home');
        } elseif ($user->kv == 2) {
            $notify[] = ['error', 'Kyc is in Pending'];
            return redirect()->route('user.home')->withNotify($notify);
        } else {
            $notify[] = ['error', 'You need to be kyc verified'];
            return redirect()->route('user.home')->withNotify($notify);
        }

    }

    public function createAccount(Request $request, $id)
    {
        $server_ip = '188.240.63.163';
        $manager = '10007';
        $manager_pswd = 'TfTe*wA1';

        // Fetch user and form data
        $user = User::find($id);
        $form = FormIb::where('user_id', $id)->first();

        // Validate existence of user and form
        if (!$user || !$form) {
            $notify[] = ['error', !$user ? 'User not found' : 'Form not found'];
            return redirect()->route('admin.form_ib')->withNotify($notify);
        }

        // // Validate the request
        // $validatedData = $request->validate([
        //     'ib_status' => 'required|in:1,2', // Only validate IB status from form
        // ]);


        $leverage = 100;
        $initialBalance = 0;

        $country = $user->address->country;
        $city = $user->address->city;
        $state = $user->address->state;
        $address = $user->address->address;
        $zipcode = $user->address->zip;
        $phone = $user->mobile;
        $company = $user->company ?? 'None';
        $initialBalance = $validatedData['initial_balance'] ?? 0;


        // Prepare data for account creation
        $group = "real\\Multi-IB\\Default";


        $command = "C:\\AccountCreate\\bin\\Release\\net8.0\\publish\\AccountCreate.exe" .
            " " . escapeshellarg($user->firstname) .
            " " . escapeshellarg($user->lastname) .
            " " . escapeshellarg($group) .
            " " . escapeshellarg($leverage) .
            " " . escapeshellarg($user->email) .
            " " . escapeshellarg($initialBalance ?? 'Nil') .
            " " . escapeshellarg($country ?? 'Nil') .
            " " . escapeshellarg($state ?? 'Nil') .
            " " . escapeshellarg($city ?? 'Nil') .
            " " . escapeshellarg($address ?? 'Nil') .
            " " . escapeshellarg($zipcode ?? 'Nil') .
            " " . escapeshellarg($company) .
            " " . escapeshellarg($phone) .
            " " . escapeshellarg($status ?? 'RE') .
            " " . escapeshellarg($manager) .
            " " . escapeshellarg($manager_pswd) .
            " " . escapeshellarg($server_ip);



        // Execute the account creation command
        $outputFile = storage_path('logs/account_create_output.txt');

        exec($command, $output, $returnVar);

        dd($command, $output, $returnVar);

        // Log output and handle errors
        file_put_contents($outputFile, implode("\n", $output));

        if ($returnVar !== 0) {
            $notify[] = ['error', 'Failed to create Account. Please try again later.'];
            return redirect()->route('admin.form_ib')->withNotify($notify);
        }

        // Update form and user status
        $form->partner = 1;
        $user->partner = 1;

        $user->save();
        $form->save();

        $notify[] = ['success', 'Account Created and User data updated successfully.'];
        return redirect()->route('admin.form_ib')->withNotify($notify);// Redirect to the same route
    }




}


