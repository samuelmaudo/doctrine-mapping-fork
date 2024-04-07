<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column\Name;

final class UndefinedName
{
    public function __construct(
        public $id,
        public $parentId,
    ) {}
}
