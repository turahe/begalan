<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complete extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * @var string[]
     */
    protected $dates = ['completed_at'];
    /**
     * @var bool
     */
    public $timestamps = false;
}
