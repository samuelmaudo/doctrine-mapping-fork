<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\Cascade;

final class RefreshCascade
{
    public function __construct(
        public $association1,
        public $association2,
    ) {}
}
