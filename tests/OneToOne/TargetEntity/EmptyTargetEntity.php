<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\TargetEntity;

final class EmptyTargetEntity
{
    public function __construct(
        public $association,
    ) {}
}
