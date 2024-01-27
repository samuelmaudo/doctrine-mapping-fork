<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix;

final class FalseColumnPrefix
{
    public function __construct(
        public ValueObject $field,
    ) {}
}
