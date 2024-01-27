<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Column;

final class UndefinedColumn
{
    public function __construct(
        public $id,
        public $parentId,
    ) {}
}
