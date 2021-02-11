<?php

namespace App\Http\Pipelines\QueryFilters;

class Customer extends Filter
{
    protected function applyFilters($builder)
    {
        // TODO: Implement applyFilters() method.
        return $builder->where('customer_id', request($this->filterName()));
    }
}
