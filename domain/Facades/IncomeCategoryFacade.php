<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;
use domain\Services\IncomeCategoryService;

class IncomeCategoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return IncomeCategoryService::class;
    }
}
