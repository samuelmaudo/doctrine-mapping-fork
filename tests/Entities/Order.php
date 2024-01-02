<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Entities;

/**
 * @internal
 */
final class Order
{
    public function __construct(
        public $id,
        public $number,
    ) {}
}
