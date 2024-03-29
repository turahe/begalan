<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Payment.
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property int|null $user_id
 * @property string|null $amount
 * @property string|null $total_amount
 * @property string|null $fees_name
 * @property string|null $fees_amount
 * @property string|null $fees_total
 * @property string|null $fees_type
 * @property string|null $payment_method
 * @property string|null $status
 * @property string|null $currency
 * @property string|null $token_id
 * @property string|null $card_last4
 * @property string|null $card_id
 * @property string|null $card_brand
 * @property string|null $card_country
 * @property string|null $card_exp_month
 * @property string|null $card_exp_year
 * @property string|null $client_ip
 * @property string|null $charge_id_or_token
 * @property string|null $payer_email
 * @property string|null $description
 * @property string|null $local_transaction_id
 * @property int|null $payment_created
 * @property string|null $bank_swift_code
 * @property string|null $account_number
 * @property string|null $branch_name
 * @property string|null $branch_address
 * @property string|null $account_name
 * @property string|null $iban
 * @property string|null $payment_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read string $status_context
 * @property-read \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereBankSwiftCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereBranchAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereBranchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCardCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCardExpMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCardExpYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCardLast4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereChargeIdOrToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereClientIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereFeesAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereFeesName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereFeesTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereFeesType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereIban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereLocalTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTokenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Payment extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    public const PAYMENT_CHANNELS = ['credit_card', 'mandiri_clickpay', 'cimb_clicks',
        'bca_klikbca', 'bca_klikpay', 'bri_epay', 'echannel', 'permata_va',
        'bca_va', 'bni_va', 'other_va', 'gopay', 'indomaret',
        'danamon_online', 'akulaku', ];

    public const EXPIRY_DURATION = 7;

    public const EXPIRY_UNIT = 'days';

    public const CHALLENGE = 'challenge';

    public const SUCCESS = 'success';

    public const SETTLEMENT = 'settlement';

    public const PENDING = 'pending';

    public const DENY = 'deny';

    public const EXPIRE = 'expire';

    public const CANCEL = 'cancel';

    public const PAYMENTCODE = 'PAY';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrolls');
    }

    /**
     * @return $this
     */
    public function do_enroll($cart_course)
    {
        $carbon = Carbon::now()->toDateTimeString();
        $data = [
            'course_id' => $cart_course['course_id'],
            'user_id' => $this->user_id,
            'course_price' => $cart_course['price'],
            'payment_id' => $this->id,
            'status' => $this->status,
            'enrolled_at' => $carbon,
        ];
        DB::table('enrolls')->insert($data);

        return $this;
    }

    /**
     * @return $this
     */
    public function distribute_earning()
    {
        $enable_instructors_earning = (bool) get_option('enable_instructors_earning');

        if ($enable_instructors_earning) {
            $enrolls = DB::table('enrolls')->wherePaymentId($this->id)->get();

            if ($enrolls->count()) {
                foreach ($enrolls as $enroll) {
                    $course_price = $enroll->course_price;

                    $course = Course::find($enroll->course_id);

                    $admin_share = get_option('admin_share');
                    $instructor_share = get_option('instructor_share');

                    $admin_amount = ($course_price * $admin_share) / 100;
                    $instructor_amount = ($course_price * $instructor_share) / 100;

                    $data = [
                        'instructor_id' => $course->user_id,
                        'course_id' => $course->id,
                        'payment_id' => $this->id,
                        'payment_status' => $this->status,
                        'amount' => $enroll->course_price,
                        'instructor_amount' => $instructor_amount,
                        'admin_amount' => $admin_amount,
                        'instructor_share' => $instructor_share,
                        'admin_share' => $admin_share,
                    ];

                    Earning::create($data);
                }
            }
        }

        return $this;
    }

    /**
     * @return mixed
     *
     * Create Payment, Share Earning and enroll to the course
     */
    public static function create_and_sync($data)
    {
        $cart = cart();

        //If any fees, add it to Payment
        if ($cart->enable_charge_fees) {
            $data['fees_name'] = $cart->fees_name;
            $data['fees_amount'] = $cart->fees_amount;
            $data['fees_type'] = $cart->fees_type;
            $data['fees_total'] = $cart->fees_total;
        }

        $payment = self::create($data);
        if (is_array($cart->courses) && count($cart->courses)) {
            foreach ($cart->courses as $course) {
                $payment->do_enroll($course)->distribute_earning();
            }
        }
        $payment->user->enroll_sync();

        return $payment;
    }

    /**
     * @param  array  $data
     * @return $this
     *
     * Update payment and update to enroll, related earnings.
     */
    public function save_and_sync($data = [])
    {
        if (is_array($data) && count($data)) {
            $this->update($data);
        } else {
            $this->save();
        }

        DB::table('earnings')->where('payment_id', $this->id)->update(['payment_status' => $this->status]);
        DB::table('enrolls')->where('payment_id', $this->id)->update(['status' => $this->status]);

        $this->user->enroll_sync();

        return $this;
    }

    /**
     * @return $this
     *
     * @throws \Exception
     *
     * Delete the Payment and delete all data related this payment
     */
    public function delete_and_sync()
    {
        DB::table('earnings')->where('payment_id', $this->id)->delete();
        DB::table('enrolls')->where('payment_id', $this->id)->delete();
        $this->delete();

        return $this;
    }

    /**
     * @return string
     */
    public function getStatusContextAttribute()
    {
        $statusClass = '';
        $iclass = '';
        switch ($this->status) {
            case 'initial':
                $statusClass .= 'secondary';
                $iclass = 'clock-o';
                break;
            case 'pending':
                $statusClass .= 'dark';
                $iclass = 'clock-o';
                break;
            case 'onhold':
                $statusClass .= 'warning';
                $iclass = 'hourglass';
                break;
            case 'success':
                $statusClass .= 'success';
                $iclass = 'check-circle';
                break;
            case 'failed':
            case 'declined':
            case 'dispute':
            case 'expired':
                $statusClass .= 'danger';
                $iclass = 'exclamation-circle';
                break;
        }

        $html = "<span class='badge payment-status-{$this->status} badge-{$statusClass}'> <i class='la la-{$iclass}'></i> {$this->status}</span>";

        return $html;
    }
}
