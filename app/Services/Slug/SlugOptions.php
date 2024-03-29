<?php

namespace App\Services\Slug;

/**
 * Class SlugOptions.
 */
class SlugOptions
{
    /** @var array|callable */
    public $generateSlugFrom;

    public string $slugField;

    public bool $generateUniqueSlugs = true;

    public int $maximumLength = 250;

    public bool $generateSlugsOnCreate = true;

    public bool $generateSlugsOnUpdate = true;

    public bool $preventOverwrite = false;

    public string $slugSeparator = '-';

    public string $slugLanguage = 'en';

    public array $translatableLocales = [];

    /**
     * @return static
     */
    public static function create(): self
    {
        return new static();
    }

    /**
     * @return static
     */
    public static function createWithLocales(array $locales): self
    {
        $slugOptions = static::create();

        $slugOptions->translatableLocales = $locales;

        return $slugOptions;
    }

    /**
     * @param  string|array|callable  $fieldName
     * @return SlugOptions
     */
    public function generateSlugsFrom($fieldName)
    {
        if (is_string($fieldName)) {
            $fieldName = [$fieldName];
        }

        $this->generateSlugFrom = $fieldName;

        return $this;
    }

    /**
     * @return $this
     */
    public function saveSlugsTo(string $fieldName): self
    {
        $this->slugField = $fieldName;

        return $this;
    }

    /**
     * @return $this
     */
    public function allowDuplicateSlugs(): self
    {
        $this->generateUniqueSlugs = false;

        return $this;
    }

    /**
     * @return $this
     */
    public function slugsShouldBeNoLongerThan(int $maximumLength): self
    {
        $this->maximumLength = $maximumLength;

        return $this;
    }

    /**
     * @return $this
     */
    public function doNotGenerateSlugsOnCreate(): self
    {
        $this->generateSlugsOnCreate = false;

        return $this;
    }

    /**
     * @return $this
     */
    public function doNotGenerateSlugsOnUpdate(): self
    {
        $this->generateSlugsOnUpdate = false;

        return $this;
    }

    /**
     * @return $this
     */
    public function preventOverwrite(): self
    {
        $this->preventOverwrite = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function usingSeparator(string $separator): self
    {
        $this->slugSeparator = $separator;

        return $this;
    }

    /**
     * @return $this
     */
    public function usingLanguage(string $language): self
    {
        $this->slugLanguage = $language;

        return $this;
    }
}
