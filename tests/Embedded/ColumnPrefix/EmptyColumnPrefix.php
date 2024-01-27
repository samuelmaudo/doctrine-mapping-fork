<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix;

final class EmptyColumnPrefix
{
    public function __construct(
        public ValueObject $field,
    ) {}
}
