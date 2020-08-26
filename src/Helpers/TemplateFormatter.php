<?php

namespace SevenSpan\ValueFirst\Helpers;

class TemplateFormatter
{
    /**
     * @param string $templateId
     * @param array $data
     *
     *
     * @return string
     */

    public static function formatTemplateData(string $templateId, array $data) : string
    {
        $result = "";
        $result .= $templateId;
        foreach ($data as $key => $value) {
            $result .= '~'. $value;
        }

        return $result;
    }
}
