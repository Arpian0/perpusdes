<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $payouts = Payout::where('user_id', $user->id)
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'pageTitle' => trans('financial.payout_request'),
            'payouts' => $payouts,
            'accountCharge' => $user->getAccountingCharge(),
            'readyPayout' => $user->getPayout(),
            'totalIncome' => $user->getIncome(),
        ];

        return view(getTemplate() . '.panel.financial.payout', $data);
    }

    public function requestPayout()
    {
        $user = auth()->user();
        $getUserPayout = $user->getPayout();
        $getFinancialSettings = getFinancialSettings();

        if ($getUserPayout < $getFinancialSettings['minimum_payout']) {
            $toastData = [
                'title' => trans('public.request_failed'),
                'msg' => trans('public.income_los_then_minimum_payout'),
                'status' => 'error'
            ];
            return back()->with(['toast' => $toastData]);
        }

        if (!empty($user->selectedBank)) {

            Payout::create([
                'user_id' => $user->id,
                'user_selected_bank_id' => $user->selectedBank->id,
                'amount' => $getUserPayout,
                'status' => Payout::$waiting,
                'created_at' => time(),
            ]);

            $notifyOptions = [
                '[payout.amount]' => handlePrice($getUserPayout),
                '[amount]' => handlePrice($getUserPayout),
                '[u.name]' => $user->full_name
            ];

            sendNotification('payout_request', $notifyOptions, $user->id);
            sendNotification('payout_request_admin', $notifyOptions, 1); // for admin
            sendNotification('new_user_payout_request', $notifyOptions, 1); // for admin

            $toastData = [
                'title' => trans('public.request_success'),
                'msg' => trans('update.payout_request_registered_successful_hint'),
                'status' => 'success'
            ];
            return back()->with(['toast' => $toastData]);
        }

        $toastData = [
            'title' => trans('public.request_failed'),
            'msg' => trans('site.check_identity_settings'),
            'status' => 'error'
        ];
        return back()->with(['toast' => $toastData]);
    }
}
