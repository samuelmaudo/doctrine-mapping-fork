<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field\Id;

final class UndefinedId
{
    public function __construct(
        public $field,
    ) {}
}
