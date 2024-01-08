<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded\Class;

final class ExistingId
{
    public function __construct(
        public string $value,
    ) {}
}
