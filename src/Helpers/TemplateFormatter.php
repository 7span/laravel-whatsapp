<?php

declare(strict_types=1);

namespace SevenSpan\ValueFirst\Helpers;

class TemplateFormatter
{
    public static function formatTemplateData(string $templateId, array $data): string
    {
        $result = '';
        $result .= $templateId;
        foreach ($data as $key => $value) {
            $result .= '~'.$value;
        }

        return $result;
    }
}
