<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Nullable;

final class DefinedNullableId
{
    public function __construct(
        public $id,
    ) {}
}
