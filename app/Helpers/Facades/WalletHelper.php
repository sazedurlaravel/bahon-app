<?php
namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;

class WalletHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return  'WalletHelper';
    }
}