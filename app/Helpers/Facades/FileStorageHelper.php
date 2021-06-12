<?php
namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade;

class FileStorageHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'FileStorageHelper';
    }
}