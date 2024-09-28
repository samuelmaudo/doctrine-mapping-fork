<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy;

final class EmptyInversedBy
{
    public function __construct(
        public $association,
    ) {}
}
