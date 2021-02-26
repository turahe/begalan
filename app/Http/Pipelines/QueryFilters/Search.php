<?php

namespace App\Http\Pipelines\QueryFilters;

class Search extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder->where('title', 'like', '%'.request($this->filterName()).'%');
    }
}
