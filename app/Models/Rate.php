<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Rate
 *
 * @property int $id
 * @property int $user_id
 * @property string $model_type
 * @property int $model_id
 * @property int $rating
 * @property string|null $comment
 * @property bool $approved
 * @property bool $spam
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereSpam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'approved' => 'boolean',
        'spam' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rating',
        'comment',
        'approved',
        'spam',
    ];

    /**
     * Set the rating for the model.
     */
    public function setRatingAttribute($value)
    {
        $this->attributes['rating'] = $value ? (int) $value : 1;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
