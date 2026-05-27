<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;
use domain\Services\UserService;

class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserService::class;
    }
}
