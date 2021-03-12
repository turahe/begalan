<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @throws \Exception
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        $chartData = null;
        if ($user->isInstructor) {
            /**
             * Format Date Name.
             */
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-t');

            $begin = new \DateTime($start_date);
            $end = new \DateTime($end_date.' + 1 day');
            $interval = \DateInterval::createFromDateString('1 day');
            $period = new \DatePeriod($begin, $interval, $end);

            $datesPeriod = [];
            foreach ($period as $dt) {
                $datesPeriod[$dt->format('Y-m-d')] = 0;
            }

            /**
             * Query This Month.
             */
            $sql = "SELECT SUM(instructor_amount) as total_earning,
              DATE(created_at) as date_format
              from earnings
              WHERE instructor_id = {$user->id} AND payment_status = 'success'
              AND (created_at BETWEEN '{$start_date}' AND '{$end_date}')
              GROUP BY date_format
              ORDER BY created_at ASC ;";
            $getEarnings = DB::select(DB::raw($sql));

            $total_earning = array_pluck($getEarnings, 'total_earning');
            $queried_date = array_pluck($getEarnings, 'date_format');

            $dateWiseSales = array_combine($queried_date, $total_earning);

            $chartData = array_merge($datesPeriod, $dateWiseSales);
            foreach ($chartData as $key => $salesCount) {
                unset($chartData[$key]);
                //$formatDate = date('d M', strtotime($key));
                $formatDate = date('d', strtotime($key));
                $chartData[$formatDate] = $salesCount;
            }
        }

        return view('theme::dashboard.dashboard', compact('chartData'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileSettings()
    {
        return view('theme::dashboard.settings.profile');
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileSettingsPost(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'job_title' => 'max:220',
        ];
        $this->validate($request, $rules);

        $input = Arr::except($request->input(), ['_token', 'social']);
        $user = Auth::user();
        $user->update($input);
        $user->update_option('social', $request->social);

        return back()->with('success', __('success'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetPassword()
    {
        return view('theme::dashboard.settings.reset_password');
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPasswordPost(Request $request)
    {
        if (config('app.is_demo')) {
            return redirect()->back()->with('error', 'This feature has been disable for demo');
        }
        $rules = [
            'old_password'  => 'required',
            'new_password'  => 'required|confirmed',
            'new_password_confirmation'  => 'required',
        ];
        $this->validate($request, $rules);

        $old_password = clean_html($request->old_password);
        $new_password = clean_html($request->new_password);

        if (Auth::check()) {
            $logged_user = Auth::user();

            if (Hash::check($old_password, $logged_user->password)) {
                $logged_user->password = Hash::make($new_password);
                $logged_user->save();

                return redirect()->back()->with('success', __('password_changed_msg'));
            }

            return redirect()->back()->with('error', __('wrong_old_password'));
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function enrolledCourses()
    {
        $title = __('enrolled_courses');

        return view('theme::dashboard.enrolled_courses', compact('title'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myReviews()
    {
        $title = __('my_reviews');

        return view('theme::dashboard.my_reviews', compact('title'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function wishlist()
    {
        $title = __('wishlist');

        return view('theme::dashboard.wishlist', compact('title'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function purchaseHistory()
    {
        $title = __('purchase_history');

        return view('theme::dashboard.purchase_history', compact('title'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function purchaseView($id)
    {
        $title = __a('purchase_view');
        $payment = Payment::find($id);

        return view('theme::dashboard.purchase_view', compact('title', 'payment'));
    }
}
