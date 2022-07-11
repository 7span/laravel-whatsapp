<?php

declare(strict_types=1);

namespace SevenSpan\WhatsAppApi\Providers;

use Illuminate\Support\ServiceProvider;
use SevenSpan\WhatsAppApi\WhatsAppApi;

class WhatsAppApiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind('WhatsAppApi', function () {
            return new WhatsAppApi();
        });
    }
}
