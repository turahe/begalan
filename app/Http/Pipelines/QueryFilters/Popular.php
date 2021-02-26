<?php

namespace App\Http\Pipelines\QueryFilters;

class Popular extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        return $builder->where('is_popular', request($this->filterName()));
    }
}
