<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Strategy;

final class IdentityStrategy
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
