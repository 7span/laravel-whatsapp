<?php

declare(strict_types=1);

namespace SevenSpan\WhatsApp\Facades;

use Illuminate\Support\Facades\Facade;

class WhatsApp extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'WhatsApp';
    }
}
