<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    public function pending()
    {
        $pageTitle = 'Pending Deposits';
        $deposits  = $this->depositData('pending');
        return view('admin.deposit.log', compact('pageTitle', 'deposits'));
    }

    public function approved()
    {
        $pageTitle = 'Approved Deposits';
        $deposits  = $this->depositData('approved');
        return view('admin.deposit.log', compact('pageTitle', 'deposits'));
    }

    public function successful()
    {
        $pageTitle = 'Successful Deposits';
        $deposits  = $this->depositData('successful');
        return view('admin.deposit.log', compact('pageTitle', 'deposits'));
    }

    public function rejected()
    {
        $pageTitle = 'Rejected Deposits';
        $deposits  = $this->depositData('rejected');
        return view('admin.deposit.log', compact('pageTitle', 'deposits'));
    }

    public function initiated()
    {
        $pageTitle = 'Initiated Deposits';
        $deposits  = $this->depositData('initiated');
        return view('admin.deposit.log', compact('pageTitle', 'deposits'));
    }

    public function deposit()
    {
        $pageTitle   = 'Deposit History';
        $depositData = $this->depositData($scope = null, $summery = true);
        $deposits    = $depositData['data'];
        $summery     = $depositData['summery'];
        $successful  = $summery['successful'];
        $pending     = $summery['pending'];
        $rejected    = $summery['rejected'];
        $initiated   = $summery['initiated'];
        return view('admin.deposit.log', compact('pageTitle', 'deposits', 'successful', 'pending', 'rejected', 'initiated'));
    }

    protected function depositData($scope = null, $summery = false)
    {
        if ($scope) {
            $deposits = Deposit::$scope()->with(['user', 'gateway', 'currency','wallet.currency']);
        } else {
            $deposits = Deposit::with(['user', 'gateway', 'currency','wallet.currency']);
        }

        $deposits = $deposits->searchable(['trx', 'user:username']);
        $request  = request();

        if ($request->date) {
            $date      = explode('-', $request->date);
            $startDate = Carbon::parse(trim($date[0]))->format('Y-m-d');
            $endDate   = @$date[1] ? Carbon::parse(trim(@$date[1]))->format('Y-m-d') : $startDate;
            $deposits  = $deposits->whereDate('deposits.created_at', '>=', $startDate)->whereDate('deposits.created_at', '<=', $endDate);
        }

        //vai method
        if ($request->method) {
            $method   = Gateway::where('alias', $request->method)->firstOrFail();
            $deposits = $deposits->where('method_code', $method->code);
        }

        if (!$summery) {
            return $deposits->orderBy('id', 'desc')->paginate(getPaginate());
        } else {

            $summationQuery    = (clone $deposits)->join('currencies', 'deposits.currency_id', 'currencies.id');
            $successfulSummery = (clone $summationQuery)->where('deposits.status', Status::PAYMENT_SUCCESS)->sum(DB::raw('currencies.rate * deposits.amount'));
            $pendingSummery    = (clone $summationQuery)->where('deposits.status', Status::PAYMENT_PENDING)->sum(DB::raw('currencies.rate * deposits.amount'));
            $rejectedSummery   = (clone $summationQuery)->where('deposits.status', Status::PAYMENT_REJECT)->sum(DB::raw('currencies.rate * deposits.amount'));
            $initiatedSummery  = (clone $summationQuery)->where('deposits.status', Status::PAYMENT_INITIATE)->sum(DB::raw('currencies.rate * deposits.amount'));

            return [
                'data'    => $deposits->orderBy('id', 'desc')->paginate(getPaginate()),
                'summery' => [
                    'successful' => $successfulSummery,
                    'pending'    => $pendingSummery,
                    'rejected'   => $rejectedSummery,
                    'initiated'  => $initiatedSummery,
                ]
            ];

        }
    }
    public function details($id)
    {
        $deposit   = Deposit::where('id', $id)->with(['user', 'gateway'])->firstOrFail();
        $pageTitle = $deposit->user->username . ' requested ' . showAmount($deposit->amount) . ' ' . gs('cur_text');
        $details   = ($deposit->detail != null) ? json_encode($deposit->detail) : null;
        return view('admin.deposit.detail', compact('pageTitle', 'deposit', 'details'));
    }


    public function approve($id)
    {
        $deposit = Deposit::where('id', $id)->where('status', Status::PAYMENT_PENDING)->firstOrFail();

        PaymentController::userDataUpdate($deposit, true);

        $notify[] = ['success', 'Deposit request approved successfully'];

        return to_route('admin.deposit.pending')->withNotify($notify);
    }

    public function reject(Request $request)
    {
        $request->validate([
            'id'      => 'required|integer',
            'message' => 'required|string|max:255'
        ]);

        $deposit = Deposit::where('id', $request->id)->where('status', Status::PAYMENT_PENDING)->firstOrFail();

        $deposit->admin_feedback = $request->message;
        $deposit->status         = Status::PAYMENT_REJECT;
        $deposit->save();

        notify($deposit->user, 'DEPOSIT_REJECT', [
            'method_name'       => $deposit->gatewayCurrency()->name,
            'method_currency'   => $deposit->method_currency,
            'method_amount'     => showAmount($deposit->final_amount),
            'amount'            => showAmount($deposit->amount),
            'charge'            => showAmount($deposit->charge),
            'rate'              => showAmount($deposit->rate),
            'trx'               => $deposit->trx,
            'rejection_message' => $request->message,
            'wallet_name'       => @$deposit->wallet->currency->symbol
        ]);

        $notify[] = ['success', 'Deposit request rejected successfully'];
        return  to_route('admin.deposit.pending')->withNotify($notify);
    }
}
