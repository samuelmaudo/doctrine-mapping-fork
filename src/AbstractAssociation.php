<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\Enums\Fetch;
use Hereldar\DoctrineMapping\Interfaces\AssociationLike;

/**
 * @psalm-immutable
 *
 * @internal
 */
abstract class AbstractAssociation implements AssociationLike
{
    /** @var non-empty-string */
    protected string $property;

    /** @var list<Cascade> */
    protected array $cascade;
    protected Fetch $fetch;

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
