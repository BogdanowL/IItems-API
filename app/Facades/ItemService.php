<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class ItemService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'itemService';
    }


}
