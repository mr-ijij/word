<?php

declare(strict_types=1);

namespace App\View;

final class Web
{
    public static function create(): self
    {
        return new self();
    }

    public function __construct()
    {
    }

    public function execute(): void
    {
    }
}
