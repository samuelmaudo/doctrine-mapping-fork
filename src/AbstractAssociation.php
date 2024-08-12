<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\Enums\Fetch;
use Hereldar\DoctrineMapping\Interfaces\AssociationLike;

/**
 * @internal
 */
abstract class AbstractAssociation implements AssociationLike
{
    /**
     * @param non-empty-string $property
     * @param list<Cascade> $cascade
     */
    protected function __construct(
        protected readonly string $property,
        protected readonly array $cascade,
        protected readonly Fetch $fetch,
    ) {}

    /**
     * @return non-empty-string
     */
    public function property(): string
    {
        return $this->property;
    }

    /**
     * @return list<Cascade>
     */
    public function cascade(): array
    {
        return $this->cascade;
    }

    public function fetch(): Fetch
    {
        return $this->fetch;
    }
}
