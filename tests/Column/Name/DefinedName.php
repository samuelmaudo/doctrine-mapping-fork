<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column\Name;

final class DefinedName
{
    public function __construct(
        public $id,
        public $parentId,
    ) {}
}
