<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Nullable;

final class UndefinedNullablePrimaryKey
{
    public function __construct(
        public ?string $id,
    ) {}
}
