<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Unique;

final class DefinedUnique
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
