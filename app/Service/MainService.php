<?php

namespace App\Service;

use Illuminate\Support\Facades\Artisan;

abstract class MainService
{
    public function refreshDataBase()
    {
        Artisan::call('migrate:fresh');
    }

}
