<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\Cascade;

final class UndefinedCascade
{
    public function __construct(
        public $association,
    ) {}
}
