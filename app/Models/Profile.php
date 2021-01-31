<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Profile.
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $gender
 * @property string|null $company_name
 * @property string|null $postcode
 * @property string|null $website
 * @property string|null $phone
 * @property string|null $about_me
 * @property string|null $date_of_birth
 * @property int|null $photo
 * @property string|null $job_title
 * @property string|null $options
 * @property string|null $user_type
 * @property int|null $active_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAboutMe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereActiveStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereWebsite($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    use HasFactory;
}
