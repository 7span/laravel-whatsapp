<?php

namespace SevenSpan\WhatsApp\Exceptions;

use Exception;

class InvalidConfig extends Exception
{
    public static function couldNotFindConfig(string $notFoundConfigName): self
    {
        return new static("Could not find the configuration for `{$notFoundConfigName}` in WhatsApp config file.");
    }
}