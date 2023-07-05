<?php

declare(strict_types=1);

namespace App\Util;

use RuntimeException;

class CliUtil
{
    public static function consoleInput(): string
    {
        /** @var resource $input */
        $input = STDIN;
        /** @var string $result */
        $result = fgets($input);

        if (!is_string($result)) {
            throw new RuntimeException('Failed to get input.');
        }

        return $result;
    }
}
