<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Hereldar\DoctrineMapping\Interfaces\FieldLike;/**
 * @psalm-immutable
 * @internal
 */
abstract class AbstractEmbedded implements FieldLike
{
    /** @var non-empty-string $property */
    protected string $property;

    /** @var non-empty-string|false $columnPrefix */
    protected string|bool $columnPrefix;

    /** @var list<FieldLike> $fields */
    protected array $fields;

    /**
     * @return non-empty-string
     */
    public function property(): string
    {
        return $this->property;
    }

    /**
     * @return non-empty-string|false
     */
    public function columnPrefix(): string|bool
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
