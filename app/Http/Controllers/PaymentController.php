<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payments\PaymentUpdateRequest;
use App\Notifications\AdminPaymentNotification;
use App\Notifications\StudentPaymentNotification;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

/**
 * Class PaymentController
 * @package App\Http\Controllers
 */
class PaymentController extends Controller
{

    /**
     * @param Request $request
     * @return RedirectResponse|View
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

        $payments = Payment::query();
        if ($request->q) {
            $payments = $payments->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%");
            });
        }
        if ($request->filter_status) {
            $payments = $payments->where('status', $request->filter_status);
        }
        $payments = $payments->orderBy('id', 'desc')->paginate(20);

        return view('admin.payments.payments', compact('title', 'payments'));
    }

    /**
     * @param $id
     * @return View
     */
    public function view(int $id): View
    {
        $title = __a('payment_details');
        $payment = Payment::find($id);
        return view('admin.payments.payment_view', compact('title', 'payment'));
    }

    /**
     * @param $id
     * @throws \Exception
     * @return RedirectResponse
     *
     * Delete the Payment
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
     * @param PaymentUpdateRequest $request
     * @param int $id
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
     * @return View
     */
    public function PaymentGateways(): View
    {
        $title = __a('payment_settings');
        return view('admin.payments.gateways.payment_gateways', compact('title'));
    }

    /**
     * @return View
     */
    public function PaymentSettings(): View
    {
        $title = __a('payment_settings');
        return view('admin.payments.gateways.payment_settings', compact('title'));
    }

    /**
     * @return View
     */
    public function thankYou(): View
    {
        $title = __t('payment_thank_you');
        return view(theme('payment-thank-you'), compact('title'));
    }
}
