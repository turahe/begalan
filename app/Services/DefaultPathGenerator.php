<?php


namespace App\Services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator as BasePath;

class DefaultPathGenerator extends BasePath
{
    /*
    * Get a unique base path for the given media.
    */
    protected function getBasePath(Media $media): string
    {
        return config('app.unique_id').'/'.$media->getKey();
    }

}