<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    8/15/20, 12:55 AM
 *  @name          toko
 * @author         Wachid
 * @copyright      Copyright (c) 2019-2020.
 */

namespace App\Services\Helpers;

class Themes
{
    const THEME_PATH = 'themes';
    const  SELLING_THEME_PATH = 'themes/_selling';

    /**
     * Return active theme name.
     * @return string
     */
    public function active_theme()
    {
        return config('system_settings.active_theme', null) ?: 'default';
    }

    /**
     * Return given/active theme path.
     *
     * @param null $theme name the theme
     * @return string
     */
    public function theme_path($theme = null)
    {
        if ($theme == null) {
            $theme = $this->active_theme();
        }

        return public_path(self::THEME_PATH.DIRECTORY_SEPARATOR.strtolower($theme));
    }

    /**
     * Return given/active theme views path.
     *
     * @param null $theme name the theme
     * @return string
     */
    public function theme_views_path($theme = null)
    {
        return $this->theme_path($theme).'/views';
    }

    /**
     * Return given/active theme assets path.
     *
     * @param null $asset name the theme
     * @param null $theme name the theme
     * @return string
     */
    public function theme_asset_url($asset = null, $theme = null)
    {
        if ($theme == null) {
            $theme = $this->active_theme();
        }

        $path = asset(self::THEME_PATH.'/'.$theme.'/assets');

        return  $asset == null ? $path : "{$path}/{$asset}";
    }

    /**
     * Return given/active theme assets path.
     *
     * @param null $theme name the theme
     * @return string
     */
    public function theme_assets_path($theme = null)
    {
        return $this->theme_path($theme).'/assets';
    }

    /**
     * Return active selling theme name.
     * @return string
     */
    public function active_selling_theme()
    {
        return config('system_settings.selling_theme', null) ?: 'default';
    }

    /**
     * Return given/active selling theme views path.
     *
     * @param null $theme name the theme
     * @return string
     */
    public function selling_theme_path($theme = null)
    {
        if ($theme == null) {
            $theme = $this->active_selling_theme();
        }

        return public_path(self::SELLING_THEME_PATH.DIRECTORY_SEPARATOR.strtolower($theme));
    }

    /**
     * Return given/active selling theme views path.
     *
     * @param null $theme name the theme
     * @return string
     */
    public function selling_theme_views_path($theme = null)
    {
        return $this->selling_theme_path($theme).'/views';
    }

    /**
     * Return given/active selling theme assets url.
     *
     * @param null $asset name the theme
     * @param null $theme name the theme
     * @return string
     */
    public function selling_theme_asset_url($asset = null, $theme = null)
    {
        if ($theme == null) {
            $theme = $this->active_selling_theme();
        }

        $path = asset(self::SELLING_THEME_PATH.'/'.$theme.'/assets');

        return  $asset == null ? $path : "{$path}/{$asset}";
    }

    /**
     * Return given/active selling theme assets path.
     *
     * @param null $theme name the theme
     * @return string
     */
    public function selling_theme_assets_path($theme = null)
    {
        return $this->selling_theme_path($theme).'/assets';
    }
}
