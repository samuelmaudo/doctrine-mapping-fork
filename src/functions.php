<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

if (!\function_exists('to_snake_case')) {
    /**
     * @internal
     * @phpstan-pure
     * @psalm-pure
     */
    function to_snake_case(string $camelCase): string
    {
        return \strtolower(trim(\preg_replace('/[A-Z]/', '_\0', $camelCase), '_'));
    }
}
