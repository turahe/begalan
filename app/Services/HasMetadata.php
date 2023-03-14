<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    8/4/20, 10:19 PM
 *  @name          toko
 * @author         Wachid
 * @copyright      Copyright (c) 2019-2020.
 */

namespace App\Services;

use App\Models\Metadata;

trait HasMetadata
{
    /**
     * Get all meta.
     *
     * @return object
     */
    public function getAllMeta()
    {
        return collect($this->meta()->pluck('content', 'name'));
    }

    /**
     * Has meta.
     *
     * @param  string  $key
     * @return bool
     */
    public function hasMeta($key)
    {
        $meta = $this->meta()->where('name', $key)->get();

        return (bool) count($meta);
    }

    /**
     * Get meta.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return object
     */
    public function getMeta($key, $default = null)
    {
        if ($meta = $this->meta()->where('name', $key)->first()) {
            return $meta;
        }

        return $default;
    }

    /**
     * Get meta content.
     *
     * @param  string  $key
     * @return object
     */
    public function getMetaValue($key)
    {
        return $this->hasMeta($key) ? $this->getMeta($key)->content : null;
    }

    /**
     * Add meta.
     *
     * @param  string  $key
     * @param  mixed  $content
     * @return mixed
     */
    public function addMeta($key, $content)
    {
        if (! $this->meta()->where('name', $key)->count()) {
            return $this->meta()->create([
                'name' => $key,
                'content' => $content,
            ]);
        }
    }

    /**
     * Update meta.
     *
     * @param  string  $key
     * @param  mixed  $content
     * @return object|bool
     */
    public function updateMeta($key, $content)
    {
        if ($meta = $this->getMeta($key)) {
            $meta->content = $content;

            return $meta->save();
        }

        return false;
    }

    /**
     * Add or update meta if it already exists.
     *
     * @param  string  $key
     * @param  mixed  $content
     * @return object|bool
     */
    public function addOrUpdateMeta($key, $content)
    {
        return $this->hasMeta($key) ? $this->updateMeta($key, $content) : $this->addMeta($key, $content);
    }

    /**
     * Delete meta.
     *
     * @param  string  $key
     * @param  mixed  $content
     * @return bool
     */
    public function deleteMeta($key, $content = null)
    {
        return $content
            ? $this->meta()->where('name', $key)->where('content', $content)->delete()
            : $this->meta()->where('name', $key)->delete();
    }

    /**
     * Delete all meta.
     *
     * @return bool
     */
    public function deleteAllMeta()
    {
        return $this->meta()->delete();
    }

    /**
     * Meta relation.
     *
     * @return object
     */
    public function meta()
    {
        return $this->morphMany(Metadata::class, 'model');
    }
}
