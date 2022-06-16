<?php

declare(strict_types=1);

/*
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SevenSpan\ValueFirst\Facades;

use Illuminate\Support\Facades\Facade;

class ValueFirst extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'ValueFirst';
    }
}
