<?php

namespace App\Http\Pipelines\QueryFilters;

/**
 * Class Published.
 */
class Published extends Filter
{
    /**
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        return $builder->where('published_at', request($this->filterName()));
    }
}
