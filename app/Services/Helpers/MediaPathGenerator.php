<?php

namespace App\Services\Helpers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

class MediaPathGenerator extends DefaultPathGenerator
{
    /*
    * Get a unique base path for the given media.
    */
    protected function getBasePath(Media $media): string
    {
        $id = \Str::slug(config('app.unique_id'));

        return $id.'/'.$media->getKey();
    }
}
