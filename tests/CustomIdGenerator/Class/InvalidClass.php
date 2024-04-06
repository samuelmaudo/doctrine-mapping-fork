<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class;

final class InvalidClass
{
    public function __construct(
        public $id,
    ) {}
}
