<?php

namespace App\Http\Pipelines\QueryFilters;

class Level extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilters($builder)
    {
        if (request($this->filterName()) && ! in_array(0, request($this->filterName()))) {
            return $builder->whereIn('level', request($this->filterName()));
        }

        return $builder->whereIn('level', request($this->filterName()));
    }
}
