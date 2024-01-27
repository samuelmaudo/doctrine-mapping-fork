<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Nullable;

final class DefinedNullablePrimaryKey
{
    public function __construct(
        public $id,
    ) {}
}
