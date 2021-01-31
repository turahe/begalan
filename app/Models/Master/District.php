<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

/**
 * App\Models\Master\District.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $city_id
 * @property string $name
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUpdatedAt($value)
 * @property-read \App\Models\Master\City $city
 * @property-read string $address
 * @property-read mixed $city_name
 * @property-read mixed $province_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Master\Village[] $villages
 * @property-read int|null $villages_count
 */
class District extends Model
{
    /**
     * @var string
     */
    protected $table = 'tm_districts';

    /**
     * @var string[]
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * @return HasMany
     */
    public function villages(): HasMany
    {
        return $this->hasMany(Village::class, 'district_id');
    }

    /**
     * @return mixed
     */
    public function getCityNameAttribute()
    {
        return $this->city->name;
    }

    /**
     * @return mixed
     */
    public function getProvinceNameAttribute()
    {
        return $this->city->province->name;
    }

    /**
     * @return string
     */
    public function getAddressAttribute(): string
    {
        return sprintf(
            '%s, %s, %s, Indonesia',
            $this->name,
            $this->city->name,
            $this->city->province->name
        );
    }

    /**
     * Bootstrap the model and its traits.
     *
     * Caching model when updating and
     * delete cache when delete models
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::updating(function ($instance) {
            Cache::put('districts.'.$instance->name, $instance);
        });
        static::deleting(function ($instance) {
            Cache::delete('districts.'.$instance->name);
        });
    }
}
