<?php
namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;

class MdlSmsHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MdlSmsHelper';
    }
}