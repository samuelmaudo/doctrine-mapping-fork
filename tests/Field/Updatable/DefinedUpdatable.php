<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Updatable;

final class DefinedUpdatable
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
