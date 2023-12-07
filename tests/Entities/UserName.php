<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Entities;

/**
 * @internal
 */
final class UserName
{
    public function __construct(
        public string $value,
    ) {}
}
