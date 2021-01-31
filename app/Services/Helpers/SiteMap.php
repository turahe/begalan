<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    8/12/20, 9:58 PM
 *  @name          toko
 * @author         Wachid
 * @copyright      Copyright (c) 2019-2020.
 */

namespace App\Services\Helpers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class SiteMap
{
    /**
     * Return the content of the Site Map.
     */
    public function getSiteMap()
    {
        if (Cache::has('site-map')) {
            return Cache::get('site-map');
        }

        $siteMap = $this->buildSiteMap();
        Cache::add('site-map', $siteMap, 120);

        return $siteMap;
    }

    /**
     * Build the Site Map.
     */
    protected function buildSiteMap()
    {
        $postsInfo = $this->getPostsInfo();
        $categoriesInfo = $this->getCategoriesInfo();
        $data = new Collection([$postsInfo, $categoriesInfo]);
        $lastPost = $data->last();
        $lastmod = $lastPost->updated_at->format(DateTime::ATOM);
        $url = trim(url('/'), '/').'/';

        $xml = [];
        $xml[] = '<?xml version="1.0" encoding="UTF-8"?'.'>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $xml[] = '  <url>';
        $xml[] = "    <loc>$url</loc>";
        $xml[] = "    <lastmod>$lastmod</lastmod>";
        $xml[] = '    <changefreq>daily</changefreq>';
        $xml[] = '    <priority>0.8</priority>';
        $xml[] = '  </url>';

//        dd($postsInfo);

        foreach ($postsInfo as $post) {
            $xml[] = '  <url>';
            $xml[] = "    <loc>$post->url</loc>";
            $xml[] = "    <lastmod>$post->publish_atom </lastmod>";
            $xml[] = '  </url>';
        }

        $xml[] = '</urlset>';

        return implode("\n", $xml);
    }

    /**
     * Return all the posts.
     */
    protected function getPostsInfo()
    {
        return Post::where('published_at', '<=', Carbon::now())
            ->where('is_draft', 0)
            ->orderBy('published_at', 'desc')
            ->get();
    }

    /**
     * Return all the categories.
     */
    protected function getCategoriesInfo()
    {
        return Category::all();
    }
}
