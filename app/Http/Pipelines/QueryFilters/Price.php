<?php

namespace App\Http\Pipelines\QueryFilters;

class Price extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        // TODO: Implement applyFilters() method.
        return $builder->whereIn('price_plan', request($this->filterName()));
    }
}
