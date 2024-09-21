<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity;

final class NonExistingTargetEntity
{
    public function __construct(
        public $association,
    ) {}
}
