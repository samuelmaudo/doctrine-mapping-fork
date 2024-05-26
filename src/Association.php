<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use ReflectionClass;

interface Association extends AssociationLike
{
    public function targetEntity(): ReflectionClass;

    /**
     * @return class-string
     */
    public function targetEntityName(): string;

    /**
     * @return non-empty-string
     */
    public function targetEntityShortName(): string;
}
