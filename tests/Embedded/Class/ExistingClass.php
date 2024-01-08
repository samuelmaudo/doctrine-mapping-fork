<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded\Class;

final class ExistingClass
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
