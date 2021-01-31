<?php

namespace App\Libraries;

use Faker\Provider\Base;

/**
 * Class Youtube.
 */
class Youtube extends Base
{
    /**
     * @return string
     */
    public function youtubeId()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            .'abcdefghijklmnopqrstuvwxyz_-';

        $id = substr($this->shuffle($characters), 0, 11);

        return $this->generator->parse($id);
    }

    /**
     * @return string
     */
    public function youtubeUri()
    {
        return 'https://www.youtube.com/watch?v='.$this->youtubeId();
    }

    /**
     * @return string
     */
    public function youtubeShortUri()
    {
        return 'https://youtu.be/'.$this->youtubeId();
    }

    /**
     * @return string
     */
    public function youtubeEmbedUri()
    {
        return 'https://www.youtube.com/embed/'.$this->youtubeId();
    }

    /**
     * @return string
     */
    public function youtubeEmbedCode()
    {
        return '<iframe width="560" height="315" src="'.$this->youtubeEmbedUri()
            .'" frameborder="0" gesture="media" allow="encrypted-media"'
            .' allowfullscreen></iframe>';
    }

    /**
     * @return string
     */
    public function youtubeChannelUri()
    {
        return sprintf('https://www.youtube.com/%s/%s',
            $this->randomElement(['channel', 'user']),
            $this->regexify(sprintf('[a-zA-Z0-9\-]{1,%s}', $this->numberBetween(1, 20)))
        );
    }

    /**
     * @return string
     */
    public function youtubeRandomUri()
    {
        switch ($this->numberBetween(1, 3)) {

            case 2:
                return $this->youtubeShortUri();

                break;

            case 3:
                return $this->youtubeEmbedUri();

                break;

            case 1:
            default:
                return $this->youtubeUri();

                break;
        }
    }
}
