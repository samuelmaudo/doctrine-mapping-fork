<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Insertable;

final class DefinedInsertable
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
