<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    8/9/20, 4:29 AM
 *  @name          toko
 * @author         Wachid
 * @copyright      Copyright (c) 2019-2020.
 */

namespace App\Services\Libraries\Post;

use League\CommonMark\GithubFlavoredMarkdownConverter;

class Markdown
{
    /**
     * Convert markdown to HTML.
     *
     * @param string $text
     * @return string
     */
    public function generate(string $text): string
    {
        try {
            $markdown = new GithubFlavoredMarkdownConverter();

            return $markdown->convertToHtml($text);
        } catch (\Exception $exception) {
        }
    }
}
