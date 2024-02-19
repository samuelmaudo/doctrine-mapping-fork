<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Strategy;

final class NoneStrategy
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
