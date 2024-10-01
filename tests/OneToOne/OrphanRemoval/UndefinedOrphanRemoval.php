<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\OrphanRemoval;

final class UndefinedOrphanRemoval
{
    public function __construct(
        public $association,
    ) {}
}
