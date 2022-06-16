<?php

declare(strict_types=1);

namespace SevenSpan\ValueFirst\Exceptions;

use Exception;

class InvalidConfig extends Exception
{
    public static function couldNotFindConfig(string $notFoundConfigName): self
    {
        return new static("Could not find the configuration for `{$notFoundConfigName}` in valuefirst config file.");
    }
}
