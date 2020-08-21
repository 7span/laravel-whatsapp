<?php

namespace SevenSpan\ValueFirst\Exceptions;

use Exception;

class InvalidConfig extends Exception
{
    public static function couldNotFindConfig(string $notFoundConfigName): InvalidConfig
    {
        return new static("Could not find the configuration for `{$notFoundConfigName}` in valuefirst config file.");
    }
}
