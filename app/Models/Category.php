<?php

namespace App\Models;

use App\Services\Libraries\Slug\HasSlug;
use App\Services\Libraries\Slug\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $category_name
 * @property string|null $slug
 * @property int|null $category_id
 * @property int|null $thumbnail_id
 * @property string|null $icon_class
 * @property int $step
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read string $bg_color
 * @property-read Category|null $parent_category
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[] $sub_categories
 * @property-read int|null $sub_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category parent()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIconClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereThumbnailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUserId($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasSlug;
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        // TODO: Implement getSlugOptions() method.
        return SlugOptions::create()
            ->generateSlugsFrom('category_name')
            ->saveSlugsTo('slug');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeParent($query)
    {
        return $query->where('category_id', 0)->orWhere('category_id', null);
    }

    /**
     * @return mixed
     */
    public function courses()
    {
        $foreignKey = 'category_id';
        if (! $this->step) {
            $foreignKey = 'parent_category_id';
        } elseif ($this->step == 1) {
            $foreignKey = 'second_category_id';
        }

        return $this->hasMany(Course::class, $foreignKey)
            ->publish()
            ->orderBy('created_at', 'desc');
    }

    /**
     * @return string
     */
    public function categoryNameParent()
    {
        $parent_id = $this->category_id;
        $category_name = '';

        if ($parent_id) {
            $parent_category_names = [];
            while ($parent_id) {
                $category = DB::table('categories')->whereId($parent_id)->first();
                $parent_id = $category->category_id;
                $parent_category_names[] = $category->category_name;
            }
            //krsort($parent_category_names);
            $category_name .= ' → '.implode(' → ', $parent_category_names);
        }

        return $category_name;
    }

    /**
     * @return string
     */
    public function getCategoryNameParent()
    {
        $category_name = $this->category_name.$this->categoryNameParent();

        return $category_name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_categories()
    {
        return $this->hasMany(self::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent_category()
    {
        return $this->belongsTo(self::class, 'category_id', 'id');
    }

    /**
     * @return string
     */
    public function getBgColorAttribute()
    {
        $bg_color = '#303'.substr(md5($this->category_name), 0, 3);

        return $bg_color;
    }
}
