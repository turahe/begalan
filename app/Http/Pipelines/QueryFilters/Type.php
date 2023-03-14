<?php

namespace App\Http\Pipelines\QueryFilters;

class Type extends Filter
{
    /**
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        // TODO: Implement applyFilters() method.
        return $builder->where('type', request($this->filterName()));
    }
}
