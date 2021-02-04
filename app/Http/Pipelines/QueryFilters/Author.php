<?php

namespace App\Http\Pipelines\QueryFilters;

class Author extends Filter
{
    protected function applyFilters($builder)
    {
        // TODO: Implement applyFilters() method.
        return $builder->where('user_id', request($this->filterName()));
    }
}
