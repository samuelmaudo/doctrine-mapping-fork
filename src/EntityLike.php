<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use ReflectionClass;

interface EntityLike
{
    public function class(): ReflectionClass;

    public function className(): string;

    public function classSortName(): string;

    public function fields(): Fields;

    public function embeddedEmbeddables(): Embeddables;
}
