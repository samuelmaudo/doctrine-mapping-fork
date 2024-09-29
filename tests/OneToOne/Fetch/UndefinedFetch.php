<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\Fetch;

final class UndefinedFetch
{
    public function __construct(
        public $association,
    ) {}
}
