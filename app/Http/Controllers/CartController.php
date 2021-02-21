<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

/**
 * Class CartController.
 */
class CartController extends Controller
{
    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function addToCart(Request $request)
    {
        if (! Auth::check()) {
            if ($request->ajax()) {
                //return ['success' => 0, 'message' => 'unauthenticated'];
            }
            //return route('login');
        }

        $course_id = $request->course_id;
        $course = Course::find($course_id);

        $cartData = (array) session('cart');
        $cartData[$course->id] = [
            'hash'              => Str::random(),
            'course_id'         => $course->id,
            'title'             => $course->title,
            'price'             => $course->get_price,
            'original_price'    => $course->price,
            'price_plan'        => $course->price_plan,
            'course_url'        => route('course', $course->slug),
            'thumbnail'      => media_image_uri($course->thumbnail_id)->thumbnail,
            'price_html'      => $course->price_html(false),
        ];
        session(['cart' => $cartData]);

        if ($request->ajax()) {
            return ['success' => 1, 'cart_html' => view('theme::template-part.minicart')];
        }

        if ($request->cart_btn === 'buy_now') {
            return redirect(route('checkout'));
        }
    }

    /**
     * @param Request $request
     * @return array
     *
     * Remove From Cart
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function removeCart(Request $request)
    {
        $cartData = (array) session('cart');
        if (Arr::get($cartData, $request->cart_id)) {
            unset($cartData[$request->cart_id]);
        }
        session(['cart' => $cartData]);

        return ['success' => 1, 'cart_html' => view_template_part('template-part.minicart')];
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout()
    {
        $title = __('checkout');

        return view('theme::checkout', compact('title'));
    }

    public function payment($id)
    {
        //Set Your server key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Uncomment for production environment
        // Config::$isProduction = true;
        Config::$isSanitized = Config::$is3ds = true;

        $payment = Payment::findOrFail($id);

        $transaction_details = [
            'order_id' => $payment->local_transaction_id,
            'gross_amount' => (int) $payment->amount, // no decimal allowed for creditcard
        ];

        // Optional
        $user = Auth::user();
        $name = explode(' ', trim($user->name));
        $first_name = $name[0];
        $last_name = array_pop($name);

        $customer_details = [
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'email'         => $payment->email,
            'phone'         => $user->phone,
            'billing_address'  => isset($user->address) ? $user->address : $user->address_2,
//            'shipping_address' => $shipping_address
        ];
        // Fill transaction details
        $transaction = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        ];
        $token = Snap::getSnapToken($transaction);

        return view('theme::checkout-pay', compact('token'));
    }
}
