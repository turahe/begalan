<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Discussion.
 *
 * @property int $id
 * @property int|null $course_id
 * @property int|null $content_id
 * @property int|null $instructor_id
 * @property int|null $user_id
 * @property int|null $discussion_id
 * @property string|null $title
 * @property string|null $message
 * @property int|null $replied
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Content|null $content
 * @property-read \App\Models\Course|null $course
 * @property-read \Illuminate\Database\Eloquent\Collection|Discussion[] $replies
 * @property-read int|null $replies_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereDiscussionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereInstructorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereReplied($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereUserId($value)
 * @mixin \Eloquent
 */
class Discussion extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(self::class)->with('user', 'user.photo_query');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
