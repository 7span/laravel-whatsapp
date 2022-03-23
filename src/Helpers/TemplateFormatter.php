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
