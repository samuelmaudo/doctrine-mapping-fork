<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Unsigned;

final class DefinedUnsigned
{
    public function __construct(
        public $id,
        public $field,
    ) {}
}
