<?php

namespace SevenSpan\ValueFirst;

interface ValueFirstInterface
{
    /**
     * @param string $to
     * @param string $message
     * @param string $tag
     *
     * @return array|mixed
     */
    public function sendMessage(string $to, string $message, string $tag = "");
}
