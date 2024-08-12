<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Interfaces;

use Hereldar\DoctrineMapping\Embeddables;
use Hereldar\DoctrineMapping\Fields;
use ReflectionClass;

interface EntityLike
{
    /**
     * @return ReflectionClass<object>
     */
    public function class(): ReflectionClass;

    /**
     * @return class-string
     */
    public function className(): string;

    /**
     * @return non-empty-string
     */
    public function classShortName(): string;

    public function fields(): Fields;

    public function embeddedEmbeddables(): Embeddables;
}
