<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;
use domain\Services\TransactionService;

class TransactionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TransactionService::class;
    }
}
