<?php

declare(strict_types=1);

namespace SevenSpan\WhatsAppApi\Facades;

use Illuminate\Support\Facades\Facade;

class WhatsAppApi extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'WhatsAppApi';
    }
}
