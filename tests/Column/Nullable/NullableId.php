<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column\Nullable;

final class NullableId
{
    public function __construct(
        public string $id,
    ) {}
}
