<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\OrphanRemoval;

final class FalseOrphanRemoval
{
    public function __construct(
        public $association,
    ) {}
}
