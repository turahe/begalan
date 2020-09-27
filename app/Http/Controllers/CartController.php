<?php

namespace App\Http\Controllers;

use App\Course;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use function Aws\map;

/**
 * Class CartController
 * @package App\Http\Controllers
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
            'hash'              => str_random(),
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
            return ['success' => 1, 'cart_html' => view_template_part('template-part.minicart') ];
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
        if (array_get($cartData, $request->cart_id)) {
            unset($cartData[$request->cart_id]);
        }
        session(['cart' => $cartData]);
        return ['success' => 1, 'cart_html' => view_template_part('template-part.minicart') ];
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout()
    {
        $title = __('checkout');
        //Set Your server key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
// Uncomment for production environment
// Config::$isProduction = true;
        Config::$isSanitized = Config::$is3ds = true;

// Required
        $cart = cart();
//        dd($cart);
        $amount = $cart->total_amount;


        //Create payment in database
        $transaction_id = 'tran_'.time().str_random(6);
        // get unique recharge transaction id
        while ((Payment::whereLocalTransactionId($transaction_id)->count()) > 0) {
            $transaction_id = 'reid'.time().str_random(5);
        }
        $transaction_id = strtoupper($transaction_id);



//        dd($data);



        $transaction_details = array(
            'order_id' => $transaction_id,
            'gross_amount' => (int)$amount, // no decimal allowed for creditcard
        );
// Optional
        $sample = array (
            array(
                'id' => 'a1',
                'price' => 94000,
                'quantity' => 1,
                'name' => "Apple"
            ),
        );
        $item_details = array_map(function ($course) {
            return [
                'id' => $course['course_id'],
                'price' => (int)$course['price'],
                'quantity' => (int)1,
                'name' => $course['title']
            ];
        }, $cart->courses);

//        $item_details = $data;
//        dd($item_details, $sample);

//        dd($item_details, $items);
// Optional
        $user = Auth::user();
        $name = explode(' ', trim($user->name));
        $first_name = $name[0];
        $last_name = array_pop($name);

        $customer_details = array(
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'email'         => $user->email,
            'phone'         => $user->phone,
            'billing_address'  => isset($user->address) ? $user->address : $user->address_2,
//            'shipping_address' => $shipping_address
        );
// Fill transaction details
        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
//            'item_details' => $item_details,
        );

        $snapToken = Snap::getSnapToken($transaction);
//        echo "snapToken = ".$snapToken;

        return view(theme('checkout'), compact('title', 'snapToken'));
    }
}
