<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\InversedBy;

final class ExistingInversedBy
{
    public function __construct(
        public $association,
    ) {}
}
