<?php

namespace App\Http\Pipelines\QueryFilters;

/**
 * Class Brand.
 */
class Brand extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        // TODO: Implement applyFilters() method.
        return $builder->where('brand_id', request($this->filterName()));
    }
}
