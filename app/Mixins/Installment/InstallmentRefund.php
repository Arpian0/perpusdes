<?php

namespace App\Mixins\Installment;

use App\Models\Accounting;
use App\Models\Installment;
use App\Models\InstallmentOrderPayment;
use App\Models\Product;
use App\Models\Webinar;
use Illuminate\Database\Eloquent\Builder;

class InstallmentRefund
{
    public function refundOrder($order)
    {
        $orderPayments = InstallmentOrderPayment::query()
            ->where('installment_order_id', $order->id)
            ->where('status', 'paid')
            ->get();

        if ($orderPayments->isNotEmpty()) {
            foreach ($orderPayments as $payment) {

                // Buyer
                Accounting::create([
                    'user_id' => $order->user_id,
                    'amount' => $payment->amount,
                    'installment_payment_id' => $payment->id,
                    'type' => Accounting::$addiction,
                    'type_account' => Accounting::$asset,
                    'description' => trans('update.installment_refund'),
                    'created_at' => time()
                ]);

                // System
                Accounting::create([
                    'system' => true,
                    'user_id' => $order->user_id,
                    'amount' => $payment->amount,
                    'installment_payment_id' => $payment->id,
                    'type' => Accounting::$deduction,
                    'type_account' => Accounting::$income,
                    'description' => trans('update.installment_refund'),
                    'created_at' => time()
                ]);

                $payment->update([
                    'status' => 'refunded'
                ]);
            }
        }

        return true;
    }
}
