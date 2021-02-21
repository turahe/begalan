<?php

namespace App\Http\Pipelines\QueryFilters;

/**
 * Class MaxCount.
 */
class MaxCount extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        return $builder->take(request($this->filterName()));
    }
}
