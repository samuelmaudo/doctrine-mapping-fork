<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Id;

final class DefinedId
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
