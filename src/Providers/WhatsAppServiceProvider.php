<?php

declare(strict_types=1);

namespace SevenSpan\WhatsApp\Providers;

use Illuminate\Support\ServiceProvider;
use SevenSpan\WhatsApp\WhatsApp;

class WhatsAppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind('WhatsApp', function () {
            return new WhatsApp();
        });
    }
}
