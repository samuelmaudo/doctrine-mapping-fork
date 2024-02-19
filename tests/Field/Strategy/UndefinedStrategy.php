<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Strategy;

final class UndefinedStrategy
{
    public function __construct(
        public $field,
    ) {}
}
