<?php

namespace App\Http\Pipelines\QueryFilters;

class Duration extends Filter
{
    protected function applyFilters($builder)
    {
        if (request($this->filterName()) === '0_2') {
            $durationEnd = (60 * 60 * 3) - 1; //02:59:59

            return $builder->where('total_video_time', '<=', $durationEnd);
        } elseif (request($this->filterName()) === '3_5') {
            $durationStart = (60 * 60 * 3);
            $durationEnd = (60 * 60 * 6) - 1;

            return $builder->whereBetween('total_video_time', [$durationStart, $durationEnd]);
        } elseif (request($this->filterName()) === '6_10') {
            $durationStart = (60 * 60 * 6);
            $durationEnd = (60 * 60 * 11) - 1;

            return $builder->whereBetween('total_video_time', [$durationStart, $durationEnd]);
        } elseif (request($this->filterName()) === '11_20') {
            $durationStart = (60 * 60 * 11);
            $durationEnd = (60 * 60 * 21) - 1;

            return $builder->whereBetween('total_video_time', [$durationStart, $durationEnd]);
        } elseif (request($this->filterName()) === '21') {
            $durationStart = (60 * 60 * 21);

            return $builder->where('total_video_time', '>=', $durationStart);
        }
    }
}
