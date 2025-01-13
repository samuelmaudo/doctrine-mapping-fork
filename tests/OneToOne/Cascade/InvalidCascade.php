<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\Cascade;

final class InvalidCascade
{
    public function __construct(
        public $association,
    ) {}
}
