<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;
use domain\Services\ExpenseCategoryService;

class ExpenseCategoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ExpenseCategoryService::class;
    }
}
