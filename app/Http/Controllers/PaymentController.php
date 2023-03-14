<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payments\PaymentUpdateRequest;
use App\Models\Payment;
use App\Notifications\AdminPaymentNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Notification;

/**
 * Class PaymentController.
 */
class PaymentController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     *
     *@throws \Exception
     */
    public function index(Request $request)
    {
        $ids = $request->bulk_ids;

        //Update
        if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)) {
            foreach ($ids as $id) {
                Payment::find($id)->save_and_sync(['status' => $request->status]);
            }

            return back()->with('success', __a('bulk_action_success'));
        }
        //Delete
        if ($request->bulk_action_btn === 'delete' && is_array($ids) && count($ids)) {
            if (config('app.is_demo')) {
                return back()->with('error', __a('demo_restriction'));
            }

            foreach ($ids as $id) {
                Payment::find($id)->delete_and_sync();
            }

            return back()->with('success', __a('bulk_action_success'));
        }
        //END Bulk Actions

        $title = __a('payments');
//
//        $payments = Payment::query();
//        if ($request->q) {
//            $payments = $payments->where(function ($q) use ($request) {
//                $q->where('name', 'like', "%{$request->q}%")
//                    ->orWhere('email', 'like', "%{$request->q}%");
//            });
//        }
//        if ($request->filter_status) {
//            $payments = $payments->where('status', $request->filter_status);
//        }
//        $payments = $payments->orderBy('id', 'desc')->paginate(20);

        $payments = app(Pipeline::class)
            ->send(Payment::query())
            ->through([
                \App\Http\Pipelines\QueryFilters\Search::class,
                \App\Http\Pipelines\QueryFilters\Status::class,
                \App\Http\Pipelines\QueryFilters\Sort::class,
            ])
            ->thenReturn()
            ->paginate($request->input('limit', 10));

        return view('admin.payments.payments', compact('title', 'payments'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view(int $id)
    {
        $title = __a('payment_details');
        $payment = Payment::find($id);

        return view('admin.payments.payment_view', compact('title', 'payment'));
    }

    /**
     * @return RedirectResponse
     *
     * Delete the Payment
     *
     * @throws \Exception
     */
    public function delete($id)
    {
        $payment = Payment::find($id);
        if ($payment) {
            $payment->delete_and_sync();
        }

        return back();
    }

    /**
     * @return RedirectResponse
     *
     * Update the payment status, and it's related data
     */
    public function updateStatus(PaymentUpdateRequest $request, int $id): RedirectResponse
    {
        $payment = Payment::find($id);
        if ($payment) {
            $payment->status = $request->status;
            $payment->save_and_sync();
        }

        $user = $payment->user;

        Notification::send($user, new AdminPaymentNotification($payment));

        return back()->with('success', __a('success'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function PaymentGateways()
    {
        $title = __a('payment_settings');

        return view('admin.payments.gateways.payment_gateways', compact('title'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function PaymentSettings()
    {
        $title = __a('payment_settings');

        return view('admin.payments.gateways.payment_settings', compact('title'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function thankYou()
    {
        $title = __t('payment_thank_you');

        return view('theme::payment-thank-you', compact('title'));
    }
}
