<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\PrimaryKey;

final class DefinedPrimaryKey
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
