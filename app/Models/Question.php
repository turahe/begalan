<?php

namespace App\Models;

use App\Contracts\Sortable;
use App\Services\SortableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Question.
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $quiz_id
 * @property string|null $title
 * @property int|null $image_id
 * @property string|null $type
 * @property string|null $score
 * @property int|null $sort_order
 * @property-read mixed $image_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuestionOption[] $options
 * @property-read int|null $options_count
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $order_column
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Quiz $quiz
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Question ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUpdatedAt($value)
 */
class Question extends Model implements HasMedia, Sortable
{
    use InteractsWithMedia;
    use SortableTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'quiz_id',
        'title',
        'type',
        'score',
    ];

    /**
     * @return HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class)->orderBy('order_column', 'asc');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    /**
     * Get image url of question.
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->hasMedia()) {
            return $this->getFirstMediaUrl();
        }

        return Storage::url('image/not-found.jpg');
    }

    /**
     * @throws \Exception
     */
    public function delete_sync()
    {
        $this->options()->delete();
        $this->delete();
    }
}
