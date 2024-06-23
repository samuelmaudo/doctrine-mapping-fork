<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Interfaces;

use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\Enums\Fetch;

interface AssociationLike
{
    /**
     * @return non-empty-string
     */
    public function property(): string;

    /**
     * @return Cascade
     */
    public function cascade(): array;

    public function fetch(): Fetch;
}
