<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class;

final class ExistingClass
{
    public function __construct(
        public $id,
    ) {}
}
