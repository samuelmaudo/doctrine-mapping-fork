<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded\Property;

final class ExistingProperty
{
    public function __construct(
        public ValueObject $field,
    ) {}
}
