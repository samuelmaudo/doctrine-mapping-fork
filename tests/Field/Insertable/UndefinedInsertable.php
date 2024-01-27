<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Insertable;

final class UndefinedInsertable
{
    public function __construct(
        public $field,
    ) {}
}
