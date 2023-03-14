<?php

namespace App\Http\Pipelines\QueryFilters;

/**
 * Class Shop.
 */
class Shop extends Filter
{
    /**
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        // TODO: Implement applyFilters() method.
        return $builder->where('shop_id', request($this->filterName()));
    }
}
