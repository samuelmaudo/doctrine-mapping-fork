<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column\Nullable;

final class UndefinedNullable
{
    public function __construct(
        public string $field,
        public ?string $nullableField,
    ) {}
}
