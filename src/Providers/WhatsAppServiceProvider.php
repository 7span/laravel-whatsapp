<?php

declare(strict_types=1);

namespace SevenSpan\WhatsApp\Providers;

use SevenSpan\WhatsApp\WhatsApp;
use Illuminate\Support\ServiceProvider;
use SevenSpan\WhatsApp\Exceptions\InvalidConfig;

class WhatsAppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/whatsApp.php' => config_path('whatsApp.php'),
            ], 'config');
        }

        $this->app->bind('WhatsApp', function () {
            $this->ensureConfigValuesAreSet();
            return new WhatsApp();
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/whatsApp.php', 'whatsApp');
    }

    protected function ensureConfigValuesAreSet(): void
    {
        $mandatoryAttributes = config('whatsApp');
        foreach ($mandatoryAttributes as $key => $value) {
            if (empty($key)) {
                throw InvalidConfig::couldNotFindConfig($key);
            }
        }
    }
}
