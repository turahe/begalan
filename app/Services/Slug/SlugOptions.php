<?php

namespace App\Services\Slug;

/**
 * Class SlugOptions.
 */
class SlugOptions
{
    /** @var array|callable */
    public $generateSlugFrom;

    /**
     * @var string
     */
    public string $slugField;

    /**
     * @var bool
     */
    public bool $generateUniqueSlugs = true;

    /**
     * @var int
     */
    public int $maximumLength = 250;

    /**
     * @var bool
     */
    public bool $generateSlugsOnCreate = true;

    /**
     * @var bool
     */
    public bool $generateSlugsOnUpdate = true;

    /**
     * @var bool
     */
    public bool $preventOverwrite = false;

    /**
     * @var string
     */
    public string $slugSeparator = '-';

    /**
     * @var string
     */
    public string $slugLanguage = 'en';

    /**
     * @var array
     */
    public array $translatableLocales = [];

    /**
     * @return static
     */
    public static function create(): self
    {
        return new static();
    }

    /**
     * @param array $locales
     * @return static
     */
    public static function createWithLocales(array $locales): self
    {
        $slugOptions = static::create();

        $slugOptions->translatableLocales = $locales;

        return $slugOptions;
    }

    /**
     * @param string|array|callable $fieldName
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
     * @param string $fieldName
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
     * @param int $maximumLength
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
     * @param string $separator
     * @return $this
     */
    public function usingSeparator(string $separator): self
    {
        $this->slugSeparator = $separator;

        return $this;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function usingLanguage(string $language): self
    {
        $this->slugLanguage = $language;

        return $this;
    }
}
