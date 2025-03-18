<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountTypeControllerModal;
use App\Models\UserAccounts;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AccountTypeController extends Controller
{
    protected function paginateArray(array $data, Request $request, $perPage)
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

    protected function countries()
    {
        return $countries = [
            "All",
            "Afghanistan",
            "Albania",
            "Algeria",
            "Andorra",
            "Angola",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Australia",
            "Austria",
            "Azerbaijan",
            "Bahamas",
            "Bahrain",
            "Bangladesh",
            "Barbados",
            "Belarus",
            "Belgium",
            "Belize",
            "Benin",
            "Bhutan",
            "Bolivia",
            "Bosnia and Herzegovina",
            "Botswana",
            "Brazil",
            "Brunei",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cabo Verde",
            "Cambodia",
            "Cameroon",
            "Canada",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Colombia",
            "Comoros",
            "Congo",
            "Costa Rica",
            "Croatia",
            "Cuba",
            "Cyprus",
            "Czech Republic",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "East Timor",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Eswatini",
            "Ethiopia",
            "Fiji",
            "Finland",
            "France",
            "Gabon",
            "Gambia",
            "Georgia",
            "Germany",
            "Ghana",
            "Greece",
            "Grenada",
            "Guatemala",
            "Guinea",
            "Guinea-Bissau",
            "Guyana",
            "Haiti",
            "Honduras",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran",
            "Iraq",
            "Ireland",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Kuwait",
            "Kyrgyzstan",
            "Laos",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Mauritania",
            "Mauritius",
            "Mexico",
            "Micronesia",
            "Moldova",
            "Monaco",
            "Mongolia",
            "Montenegro",
            "Morocco",
            "Mozambique",
            "Myanmar",
            "Namibia",
            "Nauru",
            "Nepal",
            "Netherlands",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "North Korea",
            "North Macedonia",
            "Norway",
            "Oman",
            "Pakistan",
            "Palau",
            "Panama",
            "Papua New Guinea",
            "Paraguay",
            "Peru",
            "Philippines",
            "Poland",
            "Portugal",
            "Qatar",
            "Romania",
            "Russia",
            "Rwanda",
            "Saint Kitts and Nevis",
            "Saint Lucia",
            "Saint Vincent and the Grenadines",
            "Samoa",
            "San Marino",
            "Sao Tome and Principe",
            "Saudi Arabia",
            "Senegal",
            "Serbia",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "South Korea",
            "South Sudan",
            "Spain",
            "Sri Lanka",
            "Sudan",
            "Suriname",
            "Sweden",
            "Switzerland",
            "Syria",
            "Taiwan",
            "Tajikistan",
            "Tanzania",
            "Thailand",
            "Togo",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Tuvalu",
            "Uganda",
            "Ukraine",
            "United Arab Emirates",
            "United Kingdom",
            "United States",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Vatican City",
            "Venezuela",
            "Vietnam",
            "Yemen",
            "Zambia",
            "Zimbabwe"
        ];
    }

    public function index(Request $request)
    {
        $pageTitle = 'Account Types';
        $accountList = AccountTypeControllerModal::orderBy('priority', 'asc')->get()->toArray() ?? collect([]);
        $paginator = $this->paginateArray($accountList, $request, 10);
        return view('admin.accounttype.Account_type.index', compact('pageTitle', 'paginator'));
    }

    public function create()
    {
        $pageTitle = 'Create Account Type';
        $countryList = $this->countries();
        return view('admin.accounttype.Account_type.edit', compact('pageTitle', 'countryList'));
    }

    protected function validateData(Request $request)
    {
        return $request->validate([
            'priority' => 'required|integer',
            'title' => 'required|string',
            'leverage' => 'required|string',
            'country' => 'required|array',
            'badge' => 'nullable|string',
            'deposit' => 'required|integer|min:1',
            'spread' => 'required|string',
            'status' => 'required|string|in:Active,Inactive',
            'description' => 'required|string',
            'commision' => 'required|string',
            'liveAccount' => 'nullable|string',
            'liveSwapFree' => 'sometimes|boolean',
            'liveIslamicInput' => 'nullable|string',
            'demoAccount' => 'nullable|string',
            'demoSwapFree' => 'sometimes|boolean',
            'demoIslamicInput' => 'nullable|string',
        ]);
    }

    protected function mapRequestData(Request $request)
    {
        return [
            'title' => $request->input('title'),
            'priority' => $request->input('priority'),
            'leverage' => $request->input('leverage'),
            'country' => json_encode($request->input('country')),
            'badge' => $request->input('badge'),
            'initial_deposit' => $request->input('deposit'),
            'spread' => $request->input('spread'),
            'description' => $request->input('description'),
            'commision' => $request->input('commision'),
            'status' => $request->input('status'),
            'live_account' => $request->input('liveAccount'),
            'live_islamic' => $request->has('liveSwapFree') ? 1 : 0,
            'live_islamic_input' => $request->input('liveIslamicInput'),
            'demo_account' => $request->input('demoAccount'),
            'demo_islamic' => $request->has('demoSwapFree') ? 1 : 0,
            'demo_islamic_input' => $request->input('demoIslamicInput'),
        ];
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $this->validateData($request);
        AccountTypeControllerModal::create($this->mapRequestData($request));
        notify($user, 'ACCOUNT_TYPE_STORED', []);
        $notify[] = ['success', 'Account type created successfully'];
        return redirect()->route('admin.accounttype.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $countryList = $this->countries();
        $accountType = AccountTypeControllerModal::find($id);
        if (!$accountType) {
            $notify[] = ['error', 'Account type not found'];
            return redirect()->route('admin.accounttype.index')->withNotify($notify);
        }
        $pageTitle = 'Edit Account Type';
        return view('admin.accounttype.Account_type.edit', compact('accountType', 'countryList', 'pageTitle'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $accountType = AccountTypeControllerModal::find($id);
        if (!$accountType) {
            $notify[] = ['error', 'Account type not found'];
            return redirect()->route('admin.accounttype.index')->withNotify($notify);
        }

        $validatedData = $this->validateData($request);
        $accountType->update($this->mapRequestData($request));
        notify($user, 'ACCOUNT_TYPE_UPDATED', []);
        $notify[] = ['success', 'Account type updated successfully'];
        return redirect()->route('admin.accounttype.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        AccountTypeControllerModal::findOrFail($id)->delete();
        notify($user, 'ACCOUNT_TYPE_DELETED', []);
        $notify[] = ['success', 'Account type deleted successfully'];
        return redirect()->route('admin.accounttype.index')->withNotify($notify);
    }


    public function newAccounts(Request $request)
    {
        $pageTitle = 'Open New Accounts';
        $user = Auth::user();

        // Fetch account types where status is active (status = 1)
        $accountTypes = AccountTypeControllerModal::where('status', 1)->get()->toArray() ?? [];

        return view('templates.basic.user.accounttype.index', compact('user', 'accountTypes', 'pageTitle'));
    }

    public function accountView($id)
    {
        $account = AccountTypeControllerModal::find($id);
        if (!$account) {
            abort(404, 'Account not found');
        }
        $pageTitle = 'Account Options';
        return view('templates.basic.user.accounttype.accounts', compact('pageTitle', 'account'));
    }

    public function GetUserAccounts()
    {
        $user = Auth::user();

        // Fetch accounts from mt5_users
        $accounts = DB::connection('mbf-dbmt5')
            ->table('mt5_users')
            ->where('Email', $user->email)
            ->where(function ($query) {
                $query->where('Group', 'like', '%demo%')
                    ->orWhere('Group', 'like', '%Demo%')
                    ->orWhere('Group', 'like', '%real%')
                    ->orWhere('Group', 'like', '%Real%');
            })
            ->get();

        // Fetch user's stored accounts from user_accounts
        $storedAccounts = UserAccounts::where('User_Id', $user->id)->get();

        // Attach master password if the account exists in user_accounts
        $accounts = $accounts->map(function ($account) use ($storedAccounts) {
            $storedAccount = $storedAccounts->firstWhere('Account', $account->Login);
            $account->Master_Password = $storedAccount->Master_Password ?? null; // Assign password if found, otherwise null
            return $account;
        });

        // Separate into demo and real accounts
        $demo = $accounts->filter(fn($account) => stripos($account->Group, 'demo') !== false);
        $real = $accounts->filter(fn($account) => stripos($account->Group, 'real') !== false);

        $pageTitle = 'User Accounts';

        return view('templates.basic.user.accounttype.user-accounts', compact('demo', 'real', 'pageTitle'));
    }

    public function createAccount(Request $request)
    {
        $user = Auth::user();
        $server_ip = '188.240.63.163';
        $manager = '10007';
        $manager_pswd = 'TfTe*wA1';

        $pythonExe = env('PYTHON_EXE');
        $pythonScript = env('PYTHON_SCRIPT');

        // Validate request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'leverage' => 'required|string',
            'password' => 'required|string|min:8',
            'groups' => 'nullable|string',
            'swap_free' => 'nullable|string',
            'initial_balance' => 'nullable|numeric|min:0',
        ]);

        // Extract user and request info
        $name = $validatedData['name'];
        $lastname = $user->lastname;
        $password = $validatedData['password'];
        $email = $user->email;
        $country = $user->address->country;
        $city = $user->address->city;
        $state = $user->address->state;
        $address = $user->address->address;
        $zipcode = $user->address->zip;
        $phone = $user->mobile;
        $company = $user->company ?? 'Individual';
        $title = $validatedData['title'] ?? 'default';
        $leverage = $validatedData['leverage'];
        $initialBalance = $validatedData['initial_balance'] ?? 0;
        $group = $validatedData['groups'] ?? 'demo';
        $swapFree = isset($validatedData['swap_free'])
            ? filter_var($validatedData['swap_free'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
            : false;

        $status = $user->kv == 1 ? 'RE' : null;
        $group = $this->determineGroup($group, $country, $title, $swapFree);

        // Build the command
        $command = escapeshellarg($pythonExe) . " " . escapeshellarg($pythonScript) .
            " create" .
            " --first_name " . escapeshellarg($name) .
            " --last_name " . escapeshellarg($lastname) .
            " --password " . escapeshellarg($password) .
            " --group " . escapeshellarg($group) .
            " --leverage " . escapeshellarg($leverage) .
            " --email " . escapeshellarg($email) .
            " --initial_balance " . escapeshellarg($initialBalance) .
            " --country " . escapeshellarg($country) .
            " --state " . escapeshellarg($state) .
            " --city " . escapeshellarg($city) .
            " --address " . escapeshellarg($address) .
            " --zipcode " . escapeshellarg($zipcode) .
            " --company " . escapeshellarg($company) .
            " --phone " . escapeshellarg($phone) .
            " --status " . escapeshellarg($status) .
            " --manager " . escapeshellarg($manager) .
            " --manager_pswd " . escapeshellarg($manager_pswd) .
            " --server_ip " . escapeshellarg($server_ip);

        // Execute the command
        $output = [];
        $returnVar = 0;
        exec($command, $output, $returnVar);

        // Log the output
        \Log::info('Account Creation Output:', $output);

        // Check if the script failed
        if ($returnVar !== 0 || empty($output)) {
            \Log::error('Python script failed', ['command' => $command, 'output' => $output, 'status' => $returnVar]);
            $notify[] = ['error', 'Account creation failed. Please try again.'];
            return redirect()->route('user.user-accounts')->withNotify($notify);
        }

        // Parse the output JSON
        $data = json_decode($output[0], true);

        if (!$data || !isset($data['Login']) || !isset($data['MasterPassword'])) {
            $notify[] = ['error', 'Invalid response from account creation system.'];
            return redirect()->route('user.user-accounts')->withNotify($notify);
        }

        // Save login credentials to user accounts table
        $userAccount = new UserAccounts();
        $userAccount->User_Id = $user->id;
        $userAccount->Account = $data['Login'];
        $userAccount->Master_Password = $data['MasterPassword'];
        $userAccount->save();

        // Success
        $notify[] = ['success', 'Account created successfully'];
        return redirect()->route('user.user-accounts')->withNotify($notify);
    }

    private function determineGroup($group, $country, $title, $swapFree)
    {
        if ($group === 'real') {
            if ($country === 'Pakistan') {
                return $this->getPakistaniGroup($title, $swapFree);
            } elseif ($country === 'India') {
                return $this->getIndianGroup($title, $swapFree);
            } else {
                return $this->getGlobalGroup($title, $swapFree);
            }
        } else {
            return 'demo\\MBFX\\PREMIUM_200_USD_B';
        }
    }

    private function getPakistaniGroup($title, $swapFree)
    {
        $baseGroup = 'real\\MBFX\\B' . ($swapFree ? '\\Sf' : '\\Sw');
        switch (strtolower($title)) {
            case 'premium':
                return $baseGroup . '\\Prm\\PAK_USD';
            case 'copy trading':
                return $baseGroup . '\\Cp\\PAK_USD';
            case 'vip':
                return $baseGroup . '\\Vip\\PAK_USD';
            default:
                return $baseGroup . '\\Default\\PAK_USD'; // Default case
        }
    }

    private function getIndianGroup($title, $swapFree)
    {
        $baseGroup = 'real\\MBFX\\B' . ($swapFree ? '\\Sf' : '\\Sw');
        switch (strtolower($title)) {
            case 'premium':
                return $baseGroup . '\\Prm\\INDIA_USD';
            case 'copy trading':
                return $baseGroup . '\\Cp\\INDIA_USD';
            case 'vip':
                return $baseGroup . '\\Vip\\INDIA_USD';
            default:
                return $baseGroup . '\\Default\\INDIA_USD'; // Default case
        }
    }

    private function getGlobalGroup($title, $swapFree)
    {
        $baseGroup = 'real\\MBFX\\B' . ($swapFree ? '\\Sf' : '\\Sw');
        switch (strtolower($title)) {
            case 'premium':
                return $baseGroup . '\\Prm\\GLOBAL_USD';
            case 'copy trading':
                return $baseGroup . '\\Cp\\GLOBAL_USD';
            case 'vip':
                return $baseGroup . '\\Vip\\GLOBAL_USD';
            default:
                return $baseGroup . '\\Default\\GLOBAL_USD'; // Default case
        }
    }


}