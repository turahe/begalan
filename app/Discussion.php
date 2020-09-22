<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Discussion
 *
 * @property int $id
 * @property null|int $course_id
 * @property null|int $content_id
 * @property null|int $instructor_id
 * @property null|int $user_id
 * @property null|int $discussion_id
 * @property null|string $title
 * @property null|string $message
 * @property null|int $replied
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property-read null|\App\Content $content
 * @property-read null|\App\Course $course
 * @property-read Discussion[]|\Illuminate\Database\Eloquent\Collection $replies
 * @property-read null|int $replies_count
 * @property-read null|\App\User $user
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
        return $this->hasMany(Discussion::class)->with('user', 'user.photo_query');
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
