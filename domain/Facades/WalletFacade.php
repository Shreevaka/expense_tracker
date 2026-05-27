<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;
use domain\Services\WalletService;

class WalletFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return WalletService::class;
    }
}
