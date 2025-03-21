<?php
namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\NotificationLog;
use App\Models\NotificationTemplate;
use App\Models\Order;
use App\Models\Trade;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\FileTypeValidate;
use Illuminate\Support\Facades\DB;
use App\Services\AccountService;

class ManageUsersController extends Controller
{
    public function allUsers()
    {
        $pageTitle = 'All Users';
        $users = $this->userData();
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function activeUsers()
    {
        $pageTitle = 'Active Users';
        $users = $this->userData('active');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function bannedUsers()
    {
        $pageTitle = 'Banned Users';
        $users = $this->userData('banned');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function emailUnverifiedUsers()
    {
        $pageTitle = 'Email Unverified Users';
        $users = $this->userData('emailUnverified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function kycUnverifiedUsers()
    {
        $pageTitle = 'KYC Unverified Users';
        $users = $this->userData('kycUnverified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function kycPendingUsers()
    {
        $pageTitle = 'KYC Unverified Users';
        $users = $this->userData('kycPending');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function emailVerifiedUsers()
    {
        $pageTitle = 'Email Verified Users';
        $users = $this->userData('emailVerified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function mobileUnverifiedUsers()
    {
        $pageTitle = 'Mobile Unverified Users';
        $users = $this->userData('mobileUnverified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function mobileVerifiedUsers()
    {
        $pageTitle = 'Mobile Verified Users';
        $users = $this->userData('mobileVerified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function requestPendingUsers()
    {
        $pageTitle = 'Request Pending Users';
        $users = $this->userData('requestPending');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    protected function userData($scope = null)
    {
        if ($scope) {
            $users = User::$scope();
        } else {
            $users = User::query();
        }
        return $users->searchable(['username', 'email'])->orderBy('id', 'desc')->paginate(getPaginate());
    }


    public function detail($id)
    {


        $user = User::with('wallets.currency')->findOrFail($id);
        $pageTitle = 'User Detail - ' . $user->username;

        $widget = $user->getWidgetStats();

        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $currencies = Currency::active()->get();

        $accounts = (new AccountService())->getUserAccounts($user->email);
        $ib_accounts = (new AccountService())->getIBAccounts($user->email);


        $allUsers = User::all();
        // Fetch the user who referred the authenticated user
        $referrer = User::where('id', $user->ref_by)->first();

        $transactions = Transaction::getUserTransactions($user->id);


        return view('admin.users.detail', compact('pageTitle', 'user', 'widget', 'countries', 'accounts', 'currencies', 'ib_accounts', 'allUsers', 'referrer', 'transactions'));
    }


    public function addDirectReferral(Request $request, $id) // Add $id parameter
    {
        // Get the user to update (not the admin)
        $user = User::findOrFail($id);

        $request->validate([
            'referral_user' => 'required|exists:users,id', // Ensure referral user exists
        ]);

        $referById = $request->referral_user;

        // Prevent self-referral
        if ($referById == $user->id) {
            $notify[] = ['error', 'User cannot refer themselves'];
            return back()->withNotify($notify);
        }

        // Check if user already has a referrer
        if ($user->ref_by) {
            $notify[] = ['error', 'Referral already exists for this user'];
            return back()->withNotify($notify);
        }

        $user->ref_by = $referById;
        $user->save();

        $notify[] = ['success', 'Referral added successfully'];
        return redirect()->back()->withNotify($notify);
    }


    public function kycDetails($id)
    {
        $pageTitle = 'KYC Details';
        $user = User::findOrFail($id);
        return view('admin.users.kyc_detail', compact('pageTitle', 'user'));
    }

    public function kycApprove($id)
    {
        $user = User::findOrFail($id);
        $user->kv = 1;
        $user->ib_status = 0;
        $user->save();

        notify($user, 'KYC_APPROVE', []);

        $notify[] = ['success', 'KYC approved successfully'];
        return to_route('admin.users.kyc.pending')->withNotify($notify);
    }

    public function kycReject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->kv = Status::KYC_UNVERIFIED;
        $user->kyc_rejection_reason = $request->reason;
        $user->save();

        notify($user, 'KYC_REJECT', [
            'reason' => $request->reason
        ]);

        $notify[] = ['success', 'KYC rejected successfully'];
        return to_route('admin.users.kyc.pending')->withNotify($notify);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $countryData = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryArray = (array) $countryData;
        $countries = implode(',', array_keys($countryArray));

        $countryCode = $request->country;
        $country = $countryData->$countryCode->country;
        $dialCode = $countryData->$countryCode->dial_code;

        $request->validate([
            'firstname' => 'required|string|max:40',
            'lastname' => 'required|string|max:40',
            'email' => 'required|email|string|max:40|unique:users,email,' . $user->id,
            'mobile' => 'required|string|max:40|unique:users,mobile,' . $user->id,
            'country' => 'required|in:' . $countries,
        ]);
        $user->mobile = $dialCode . $request->mobile;
        $user->country_code = $countryCode;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->address = [
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => @$country,
        ];
        $user->ev = $request->ev ? Status::VERIFIED : Status::UNVERIFIED;
        $user->sv = $request->sv ? Status::VERIFIED : Status::UNVERIFIED;
        $user->ts = $request->ts ? Status::ENABLE : Status::DISABLE;
        if (!$request->kv) {
            $user->kv = 0;
            if ($user->kyc_data) {
                foreach ($user->kyc_data as $kycData) {
                    if ($kycData->type == 'file') {
                        fileManager()->removeFile(getFilePath('verify') . '/' . $kycData->value);
                    }
                }
            }
            $user->kyc_data = null;
        } else {
            $user->kv = 1;
        }
        $user->save();

        $notify[] = ['success', 'User details updated successfully'];
        return back()->withNotify($notify);
    }




    public function addSubBalance(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|gt:0',
            'wallet' => 'required|integer',
            'act' => 'required|in:add,sub',
            'remark' => 'required|string|max:255',
            'wallet_type' => 'required|in:' . implode(',', array_keys((array) gs('wallet_types')))
        ]);

        $user = User::findOrFail($id);
        $walletScope = $request->wallet_type;
        $wallet = Wallet::where('user_id', $user->id)->$walletScope()->where('currency_id', $request->wallet)->firstOrFail();

        $amount = $request->amount;
        $trx = getTrx();


        $transaction = new Transaction();

        if ($request->act == 'add') {

            $wallet->balance += $amount;
            $wallet->save();

            $transaction->trx_type = '+';
            $transaction->remark = 'balance_add';
            $notifyTemplate = 'BAL_ADD';

            $notify[] = ['success', $wallet->currency->sign . $amount . ' added successfully'];
        } else {
            if ($amount > $wallet->balance) {
                $notify[] = ['error', $user->username . ' doesn\'t have sufficient balance'];
                return back()->withNotify($notify);
            }

            $wallet->balance -= $amount;
            $wallet->save();

            $transaction->trx_type = '-';
            $transaction->remark = 'balance_subtract';

            $notifyTemplate = 'BAL_SUB';
            $notify[] = ['success', $wallet->currency->sign . $amount . ' subtracted successfully'];
        }

        $user->save();

        $transaction->user_id = $user->id;
        $transaction->wallet_id = $wallet->id;
        $transaction->amount = $amount;
        $transaction->post_balance = $wallet->balance;
        $transaction->charge = 0;
        $transaction->trx = $trx;
        $transaction->details = $request->remark;
        $transaction->save();


        notify($user, $notifyTemplate, [
            'trx' => $trx,
            'amount' => showAmount($amount),
            'remark' => $request->remark,
            'post_balance' => showAmount($wallet->balance),
            'wallet_currency' => @$wallet->currency->symbol,
        ]);

        return back()->withNotify($notify);
    }

    public function login($id)
    {
        Auth::loginUsingId($id);

        return to_route('user.home');
    }

    public function status(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->status == Status::USER_ACTIVE) {
            $request->validate([
                'reason' => 'required|string|max:255'
            ]);
            $user->status = Status::USER_BAN;
            $user->ban_reason = $request->reason;
            $notify[] = ['success', 'User banned successfully'];
        } else {
            $user->status = Status::USER_ACTIVE;
            $user->ban_reason = null;
            $notify[] = ['success', 'User unbanned successfully'];
        }
        $user->save();
        return back()->withNotify($notify);
    }


    public function showNotificationSingleForm($id)
    {
        $user = User::findOrFail($id);
        $general = gs();
        if (!$general->en && !$general->sn) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.users.detail', $user->id)->withNotify($notify);
        }
        $pageTitle = 'Send Notification to ' . $user->username;
        return view('admin.users.notification_single', compact('pageTitle', 'user'));
    }

    public function sendNotificationSingle(Request $request, $id)
    {

        $request->validate([
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        notify($user, 'DEFAULT', [
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        $notify[] = ['success', 'Notification sent successfully'];
        return back()->withNotify($notify);
    }

    public function showNotificationAllForm()
    {
        $general = gs();
        if (!$general->en && !$general->sn) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.dashboard')->withNotify($notify);
        }
        $notifyToUser = User::notifyToUser();
        $users = User::active()->count();
        $pageTitle = 'Notification to Verified Users';
        return view('admin.users.notification_all', compact('pageTitle', 'users', 'notifyToUser'));
    }

    public function sendNotificationAll(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'subject' => 'required',
            'start' => 'required',
            'batch' => 'required',
            'being_sent_to' => 'required',
            'user' => 'required_if:being_sent_to,selectedUsers',
            'number_of_top_deposited_user' => 'required_if:being_sent_to,topDepositedUsers|integer|gte:0',
            'number_of_days' => 'required_if:being_sent_to,notLoginUsers|integer|gte:0',
        ], [
            'number_of_days.required_if' => "Number of days field is required",
            'number_of_top_deposited_user.required_if' => "Number of top deposited user field is required",
        ]);

        if ($validator->fails())
            return response()->json(['error' => $validator->errors()->all()]);

        $scope = $request->being_sent_to;
        $users = User::oldest()->active()->$scope()->skip($request->start)->limit($request->batch)->get();
        foreach ($users as $user) {
            notify($user, 'DEFAULT', [
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
        }
        return response()->json([
            'total_sent' => $users->count(),
        ]);
    }

    public function notificationLog($id)
    {
        $user = User::findOrFail($id);
        $pageTitle = 'Notifications Sent to ' . $user->username;
        $logs = NotificationLog::where('user_id', $id)->with('user')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.reports.notification_history', compact('pageTitle', 'logs', 'user'));
    }

    public function list()
    {
        $query = User::active();

        if (request()->search) {
            $query->where(function ($q) {
                $q->where('email', 'like', '%' . request()->search . '%')->orWhere('username', 'like', '%' . request()->search . '%');
            });
        }
        $users = $query->orderBy('id', 'desc')->paginate(getPaginate());
        return response()->json([
            'success' => true,
            'users' => $users,
            'more' => $users->hasMorePages()
        ]);
    }


    public function RequestDetails($id)
    {
        $pageTitle = "Profile Change Request";
        $user = User::findOrFail($id);
        return view('admin.users.request_detail', compact('pageTitle', 'user'));
    }

    public function RequestApprove($id)
    {
        $user = User::findOrFail($id);
        $user->profile_request = 1;
        $user->save();
        notify($user, 'REQUEST_APPROVE', []);
        $notify[] = ['success', 'Profile Request Approved'];
        return to_route('admin.users.active')->withNotify($notify);
    }

    public function RequestReject(Request $request, $id)
    {

        $request->validate([
            'reason' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->profile_request = 3;
        $user->profile_request_reason = $request->reason;
        $user->save();

        notify($user, 'REQUEST_REJECT', [
            'reason' => $request->reason
        ]);

        $notify[] = ['success', 'Request Rejected Successfully'];
        return to_route('admin.users.active')->withNotify($notify);
    }
}
