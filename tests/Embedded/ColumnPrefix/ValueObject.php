<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded\ColumnPrefix;

final class ValueObject
{
    public function __construct(
        public $value,
    ) {}
}
