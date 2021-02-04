<?php

namespace App\Http\Pipelines\QueryFilters;

/**
 * Class State.
 * @package App\Http\Pipelines\QueryFilters
 */
class Status extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        // TODO: Implement applyFilters() method.
        return $builder->where('status', request($this->filterName()));
    }
}
