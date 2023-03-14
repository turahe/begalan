<?php

namespace App\Http\Pipelines\QueryFilters;

/**
 * Class State.
 */
class Status extends Filter
{
    /**
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        // TODO: Implement applyFilters() method.
        return $builder->where('status', request($this->filterName()));
    }
}
