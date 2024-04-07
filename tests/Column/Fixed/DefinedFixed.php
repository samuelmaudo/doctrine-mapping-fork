<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column\Fixed;

final class DefinedFixed
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
