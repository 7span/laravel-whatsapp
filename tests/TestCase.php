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

namespace SevenSpan\ValueFirst\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use SevenSpan\ValueFirst\Providers\ValueFirstServiceProvider;

/**
 * @internal
 * @coversNothing
 */
final class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            ValueFirstServiceProvider::class,
        ];
    }
}
