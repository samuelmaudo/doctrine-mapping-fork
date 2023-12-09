<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Entities;

/**
 * @internal
 */
final class ProductVariant
{
    public function __construct(
        public int $id,
        public int $productId,
        public string $name,
    ) {}
}
