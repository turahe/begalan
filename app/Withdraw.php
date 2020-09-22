<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Withdraw
 *
 * @property int $id
 * @property null|int $user_id
 * @property null|string $amount
 * @property null|string $method_data
 * @property null|string $description
 * @property null|string $status
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property-read mixed $status_context
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw query()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereMethodData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUserId($value)
 * @mixin \Eloquent
 */
class Withdraw extends Model
{
    protected $guarded = [];

    public function getMethodDataAttribute($value)
    {
        if ($value) {
            return json_decode($value, true);
        }
        return null;
    }



    public function getStatusContextAttribute()
    {
        $statusClass = "";
        $iclass = "";
        switch ($this->status) {
            case 'pending':
                $statusClass .= "dark";
                $iclass = "clock-o";
                break;
            case 'approved':
                $statusClass .= "success";
                $iclass = "check-circle";
                break;
            case 'rejected':
                $statusClass .= "danger";
                $iclass = "exclamation-circle";
                break;
        }

        $html = "<span class='badge withdraw-status-{$this->status} badge-{$statusClass}'> <i class='la la-{$iclass}'></i> {$this->status}</span>";
        return $html;
    }
}
