<?php

namespace App\Services\Slug;

use Exception;

class InvalidOption extends Exception
{
    /**
     * @return static
     */
    public static function missingFromField()
    {
        return new static('Could not determine which fields should be sluggified');
    }

    /**
     * @return static
     */
    public static function missingSlugField()
    {
        return new static('Could not determine in which field the slug should be saved');
    }

    /**
     * @return static
     */
    public static function invalidMaximumLength()
    {
        return new static('Maximum length should be greater than zero');
    }
}
