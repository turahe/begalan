<?php

namespace App\Http\Pipelines\QueryFilters;

class Topic extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        // TODO: Implement applyFilters() method.
        return $builder->where('category_id', request($this->filterName()));
    }
}
