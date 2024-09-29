<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\Fetch;

final class ExtraLazyFetch
{
    public function __construct(
        public $association1,
        public $association2,
    ) {}
}
