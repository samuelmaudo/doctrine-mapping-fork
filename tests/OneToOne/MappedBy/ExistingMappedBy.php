<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\MappedBy;

final class ExistingMappedBy
{
    public function __construct(
        public $association,
    ) {}
}
