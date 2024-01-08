<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded\Class;

final class UndefinedClass
{
    public function __construct(
        public ExistingId $id,
        public ExistingField $field,
    ) {}
}
