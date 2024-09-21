<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\OneToOne\Property;

final class ExistingProperty
{
    public function __construct(
        public $association,
    ) {}
}
