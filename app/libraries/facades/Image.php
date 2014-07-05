<?php namespace App\Libraries\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Image
 * @package App\Libraries\Facades
 */
class Image extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return new \App\Libraries\Image\Image;
    }

}