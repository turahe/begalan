<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Option
 *
 * @property int $id
 * @property null|string $option_key
 * @property null|string $option_value
 * @method static \Illuminate\Database\Eloquent\Builder|Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereOptionKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereOptionValue($value)
 * @mixin \Eloquent
 */
class Option extends Model
{
    protected $guarded = [];
    public $timestamps = false;
}
