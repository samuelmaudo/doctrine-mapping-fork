<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Entities;

/**
 * @internal
 */
final class Product
{
    public function __construct(
        public int $id,
        public ?int $categoryId,
        public string $name,
        public float $price,
    ) {}
}
