<?php

namespace App\Http\Pipelines\QueryFilters;

/**
 * Class Category.
 */
class Category extends Filter
{
    /**
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        // TODO: Implement applyFilters() method.
        return $builder->where('category_id', request($this->filterName()));
    }
}
