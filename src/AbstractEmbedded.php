<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Hereldar\DoctrineMapping\Interfaces\FieldLike;

/**
 * @internal
 */
abstract class AbstractEmbedded implements FieldLike
{
    /**
     * @param non-empty-string $property
     * @param non-empty-string|false|null $columnPrefix
     * @param list<FieldLike> $fields
     */
    protected function __construct(
        protected readonly string $property,
        protected readonly string|bool|null $columnPrefix,
        protected readonly array $fields,
    ) {}

    /**
     * @return non-empty-string
     */
    public function property(): string
    {
        return $this->property;
    }

    /**
     * @return non-empty-string|false|null
     */
    public function columnPrefix(): string|bool|null
    {
        return $this->columnPrefix;
    }

    /**
     * @return list<FieldLike>
     */
    public function fields(): array
    {
        return $this->fields;
    }
}
