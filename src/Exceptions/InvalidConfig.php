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

namespace SevenSpan\ValueFirst\Exceptions;

use Exception;

class InvalidConfig extends Exception
{
    public static function couldNotFindConfig(string $notFoundConfigName): self
    {
        return new static("Could not find the configuration for `{$notFoundConfigName}` in valuefirst config file.");
    }
}
