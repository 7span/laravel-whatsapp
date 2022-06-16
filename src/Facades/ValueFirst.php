<?php

declare(strict_types=1);

namespace SevenSpan\ValueFirst\Facades;

use Illuminate\Support\Facades\Facade;

class ValueFirst extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'ValueFirst';
    }
}
