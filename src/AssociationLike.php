<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\Enums\Fetch;

interface AssociationLike extends FieldLike
{
    /**
     * @return list<Cascade>
     */
    public function cascade(): array;

    public function fetch(): Fetch;
}
