<?php

declare(strict_types=1);

namespace SevenSpan\ValueFirst;

interface ValueFirstInterface
{
    /**
     * @return array|mixed
     */
    public function sendMessage(string $to, string $message, string $tag = '');
}
