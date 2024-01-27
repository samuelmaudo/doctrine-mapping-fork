<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Fixed;

final class DefinedFixed
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
