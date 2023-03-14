<?php

namespace App\Http\Pipelines\QueryFilters;

/**
 * Class Sort.
 */
class Sort extends Filter
{
    /**
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        return $builder->orderBy('title', request($this->filterName()));
    }
}
