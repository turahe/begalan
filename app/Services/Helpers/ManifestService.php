<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    8/11/20, 10:28 PM
 *  @name          toko
 * @author         Wachid
 * @copyright      Copyright (c) 2019-2020.
 */

namespace App\Services\Helpers;

/**
 * Class ManifestService.
 */
class ManifestService
{
    /**
     * @return array
     */
    public function generate(): array
    {
        $basicManifest = [
            'name' => config('global.site_name'),
            'short_name' => config('global.site_title'),
            'start_url' => asset(config('global.start_url')),
            'display' => config('global.display'),
            'theme_color' => config('global.theme_color'),
            'background_color' => config('global.background_color'),
            'orientation' =>  config('global.orientation'),
            'status_bar' =>  config('global.status_bar'),
            'splash' =>  config('global.splash'),
        ];

        foreach (config('site.manifest.icons') as $size => $file) {
            $fileInfo = pathinfo($file['path']);
            $basicManifest['icons'][] = [
                'src' => url($file['path']),
                'type' => 'image/'.$fileInfo['extension'],
                'sizes' => $size,
                'purpose' => $file['purpose'],
            ];
        }
//
//        foreach (config('global.custom') as $tag => $value) {
//            $basicManifest[$tag] = $value;
//        }

        return $basicManifest;
    }
}
