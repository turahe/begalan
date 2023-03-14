<?php

namespace App\Http\Pipelines\QueryFilters;

/**
 * Class Active.
 */
class Active extends Filter
{
    /**
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        return $builder->where('active', request($this->filterName()));
    }
}
