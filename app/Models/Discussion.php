<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Discussion
 *
 * @property int $id
 * @property int|null $course_id
 * @property int $content_id
 * @property int|null $instructor_id
 * @property int|null $user_id
 * @property int|null $parent_id
 * @property string $title
 * @property string $message
 * @property int|null $replied
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Content $content
 * @property-read \App\Models\Course|null $course
 * @property-read \Illuminate\Database\Eloquent\Collection|Discussion[] $replies
 * @property-read int|null $replies_count
 * @property-read \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion newQuery()
 * @method static \Illuminate\Database\Query\Builder|Discussion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereInstructorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereReplied($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Discussion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Discussion withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Discussion extends Model
{
    use SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->with('user', 'user.photo_query');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * @return BelongsTo
     */
    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
