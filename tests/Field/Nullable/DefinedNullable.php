<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Nullable;

final class DefinedNullable
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
