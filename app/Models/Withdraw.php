<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Withdraw.
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $amount
 * @property string|null $method_data
 * @property string|null $description
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $status_context
 *
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
 *
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
        $statusClass = '';
        $iclass = '';
        switch ($this->status) {
            case 'pending':
                $statusClass .= 'dark';
                $iclass = 'clock-o';
                break;
            case 'approved':
                $statusClass .= 'success';
                $iclass = 'check-circle';
                break;
            case 'rejected':
                $statusClass .= 'danger';
                $iclass = 'exclamation-circle';
                break;
        }

        $html = "<span class='badge withdraw-status-{$this->status} badge-{$statusClass}'> <i class='la la-{$iclass}'></i> {$this->status}</span>";

        return $html;
    }
}
