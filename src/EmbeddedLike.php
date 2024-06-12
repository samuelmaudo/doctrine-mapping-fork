<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use ReflectionClass;

interface EmbeddedLike
{
    /**
     * @param non-empty-list<FieldLike|EmbeddedLike> $fields
     */
    public function withFields(
        FieldLike|EmbeddedLike ...$fields,
    ): self;

    /**
     * @return non-empty-string
     */
    public function property(): string;

    /**
     * @return non-empty-string|false
     */
    public function columnPrefix(): string|bool;

    /**
     * @return list<FieldLike|EmbeddedLike>
     */
    public function fields(): array;
}
