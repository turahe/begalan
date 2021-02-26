<?php

namespace App\Http\Pipelines\QueryFilters;

class Rating extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        return $builder->where('rating_value', '>=', request($this->filterName()));
    }
}
