<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\CustomIdGenerator\Class;

final class AnonymousClass
{
    public function __construct(
        public $id,
    ) {}
}
