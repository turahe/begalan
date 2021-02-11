<?php

namespace App\Models;

use App\Models\Master\City;
use App\Models\Master\Country;
use App\Models\Master\District;
use App\Models\Master\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Address.
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $address
 * @property string $postal_code
 * @property string|null $phone
 * @property int|null $village_id
 * @property int|null $district_id
 * @property int $city_id
 * @property int $state_id
 * @property int $country_id
 * @property string|null $map_latitude
 * @property string|null $map_longitude
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Query\Builder|Address onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereMapLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereMapLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereVillageId($value)
 * @method static \Illuminate\Database\Query\Builder|Address withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Address withoutTrashed()
 * @mixin \Eloquent
 * @property-read City $city
 * @property-read \App\Models\Country $country
 * @property-read District|null $district
 * @property-read State $state
 * @property-read \App\Models\User $user
 */
class Address extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'model_type',
        'model_id',
        'title',
        'address',
        'postal_code',
        'phone',
        'village_id',
        'district_id',
        'city_id',
        'state_id',
        'country_id',
        'map_latitude',
        'map_longitude',
        'type',
    ];

    /**
     * Return the address's user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Return the address's country.
     *
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * Return the address's state.
     *
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * Creat new state and set the id if the given value is not available.
     * @param $value
     */
    public function setStateIdAttribute($value)
    {
        if (! is_numeric($value) and $value != null) {
            $state = State::firstOrCreate(['name' => $value, 'country_id' => request()->input('country_id')]);
            $value = $state->id;
        }

        $this->attributes['state_id'] = $value;
    }

    /**
     * Try to fetch the coordinates from Google
     * and store it to database.
     *
     * @return string|string[]
     * @return
     */
    public function toGeocodeString()
    {
        $data = [];
        $data[] = $this->address_line_1 ?? '';
        $data[] = $this->address ?? '';
        $data[] = $this->city ?? '';
        if ($this->state_id) {
            $data[] = $this->state->name;
        }
        $data[] = $this->postal_code ?? '';
        if ($this->country_id) {
            $data[] = $this->country->name;
        }

        // build str string
        $str = trim(implode(', ', array_filter($data)));

        return str_replace(' ', '+', $str);
    }

    /**
     * Return the address's city.
     *
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Return the address's district.
     *
     * @return BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * Format the address toHtml.
     *
     * @param string $separator html code
     *
     * @param bool $show_heading
     * @return string
     */
    public function toHtml($separator = '<br/>', $show_heading = true)
    {
        $html = [];

        if (User::class == $this->model_type && $show_heading) {
            $html[] = '<strong class="pull-right">'.strtoupper($this->type).'</strong>';
        }

        if (config('system_settings.show_title')) {
            $html[] = $this->title;
        }

        if (strlen($this->address)) {
            $html[] = $this->address;
        }

        if (strlen($this->city)) {
            $html[] = $this->city->name.', ';
        }

        if (strlen($this->state_id) || $this->postal_code) {
            $html[] = sprintf('%s %s', e($this->state_id ? $this->state->name : ''), e($this->postal_code));
        }

        if (config('system_settings.address_show_country') && $this->country) {
            $html[] = e($this->country->name);
        }

        if (strlen($this->phone)) {
            $html[] = '<abbr title="'.trans('app.phone').'">P:</abbr> '.e($this->phone);
        }

        $addressStr = implode($separator, $html);

        $return = '<address>'.$addressStr.'</address>';

        return $return;
    }

    /**
     * Return a "string formatted" version of the address.
     * @param bool $title
     * @return string
     */
    public function toString($title = false)
    {
        $str = [];

        if ($title || config('system_settings.show_title')) {
            $str[] = $this->title;
        }

        if (strlen($this->address)) {
            $str[] = $this->address;
        }

        if (strlen($this->city)) {
            $str[] = $this->city.', ';
        }

        if (strlen($this->state_id) || $this->postal_code) {
            $str[] = sprintf('%s %s', e($this->state_id ? $this->state->name : ''), e($this->postal_code));
        }

        // if(strlen($this->city)){
        //     $state_name = $this->state ? $this->state->name : '';
        //     $str []= sprintf('%s, %s %s', $this->city, $state_name, $this->postal_code);
        // }

        if (config('system_settings.address_show_country') && $this->country) {
            $str[] = $this->country->name;
        }

        if (strlen($this->phone)) {
            $str[] = trans('app.phone').': '.e($this->phone);
        }

        return implode(', ', $str);
    }

    /**
     * Get address as array.
     *
     * @return array|void
     */
    public function toArray()
    {
        $address = [];
        $address['type'] = $this->type;
        $address['title'] = $this->title;
        $address['address'] = $this->address;
        $address['city'] = $this->city;

        if ($this->state) {
            $address['state'] = $this->state->name;
        }

        $address['postal_code'] = $this->postal_code;

        if ($this->country) {
            $address['country'] = $this->country->name;
        }

        $address['phone'] = $this->phone;

        if ($this->map_latitude && $this->map_longitude) {
            $address['map_latitude'] = $this->map_latitude;
            $address['map_longitude'] = $this->map_longitude;
        }

        $address = array_filter($address);

        if (empty($address)) {
            return;
        }

        return $address;
    }
}
