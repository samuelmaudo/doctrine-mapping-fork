<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Interfaces;

use Hereldar\DoctrineMapping\Embeddables;
use Hereldar\DoctrineMapping\Fields;
use ReflectionClass;

interface EntityLike
{
    public function class(): ReflectionClass;

    public function className(): string;

    public function classSortName(): string;

    public function fields(): Fields;

    public function embeddedEmbeddables(): Embeddables;
}
