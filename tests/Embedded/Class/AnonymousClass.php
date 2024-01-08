<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Embedded\Class;

final class AnonymousClass
{
    public function __construct(
        public $id,
    ) {}
}
