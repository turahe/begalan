<?php

namespace App\Http\Pipelines\QueryFilters;

class Featured extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        return $builder->where('is_featured', request($this->filterName()));
    }
}
