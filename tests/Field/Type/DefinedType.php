<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Type;

final class DefinedType
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
