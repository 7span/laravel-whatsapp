<?php

declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SevenSpan\ValueFirst\Providers;

use Illuminate\Support\ServiceProvider;
use SevenSpan\ValueFirst\Exceptions\InvalidConfig;
use SevenSpan\ValueFirst\ValueFirst;

class ValueFirstServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/valuefirst.php' => config_path('valuefirst.php'),
            ], 'config');
        }

        $this->app->bind('ValueFirst', function () {
            $this->ensureConfigValuesAreSet();

            return new ValueFirst();
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/valuefirst.php', 'valuefirst');
    }

    protected function ensureConfigValuesAreSet(): void
    {
        $mandatoryAttributes = config('valuefirst');
        foreach ($mandatoryAttributes as $key => $value) {
            if (empty($value)) {
                throw InvalidConfig::couldNotFindConfig($key);
            }
        }
    }
}
