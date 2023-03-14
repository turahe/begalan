<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

/**
 * App\Models\Master\Village.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Village newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Village newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Village query()
 *
 * @mixin \Eloquent
 *
 * @property int $id
 * @property int $district_id
 * @property string $name
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereUpdatedAt($value)
 *
 * @property-read \App\Models\Master\District $district
 * @property-read string $address
 * @property-read mixed $city_name
 * @property-read mixed $district_name
 * @property-read mixed $province_name
 */
class Village extends Model
{
    /**
     * @var string
     */
    protected $table = 'tm_villages';

    /**
     * @var string[]
     */
    protected $casts = [
        'meta' => 'array',
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * @return mixed
     */
    public function getDistrictNameAttribute()
    {
        return $this->district->name;
    }

    /**
     * @return mixed
     */
    public function getCityNameAttribute()
    {
        return $this->district->city->name;
    }

    /**
     * @return mixed
     */
    public function getProvinceNameAttribute()
    {
        return $this->district->city->state->name;
    }

    public function getAddressAttribute(): string
    {
        return sprintf(
            '%s, %s, %s, %s, Indonesia',
            $this->name,
            $this->district->name,
            $this->district->city->name,
            $this->district->city->state->name
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
            Cache::put('villages.'.$instance->name, $instance);
        });
        static::deleting(function ($instance) {
            Cache::delete('villages.'.$instance->name);
        });
    }
}
