<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;
use domain\Services\ImageService;

class ImageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ImageService::class;
    }
}
