<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Error;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

/**
 * @psalm-immutable
 */
abstract class AbstractField implements FieldLike
{
    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $type
     * @param ?enum-string $enumType
     */
    protected function __construct(
        protected string $property,
        protected ?string $type,
        protected ?string $enumType,
        protected bool $insertable,
        protected bool $updatable,
        protected ?Generated $generated,
        protected Column $column,
    ) {}

    /**
     * @param non-empty-string $property Name of the field in the Entity.
     * @param ?non-empty-string $type
     * @param ?enum-string $enumType
     * @param bool $insertable Whether the field is insertable (defaults to TRUE).
     * @param bool $updatable Whether the field is updatable (defaults to TRUE).
     * @param Generated|'NEVER'|'INSERT'|'ALWAYS'|int<0, 2>|null $generated Whether a generated value should be retrieved from the database after INSERT or UPDATE.
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        string $property,
        ?string $type = null,
        ?string $enumType = null,
        bool $insertable = true,
        bool $updatable = true,
        Generated|string|int|null $generated = null,
    ): self {
        if (!$property) {
            throw MappingException::emptyPropertyName();
        }

        if ($type === '') {
            throw MappingException::emptyType($property);
        }

        if ($enumType === '') {
            throw MappingException::emptyEnumType($property);
        }

        if ($generated !== null && !is_object($generated)) {
            try {
                $generated = Generated::from($generated);
            } catch (Error) {
                throw MappingException::invalidGenerationMode(
                    $property,
                    $generated,
                );
            }
        }

        return new static(
            $property,
            $type,
            $enumType,
            $insertable,
            $updatable,
            $generated,
            Column::empty(),
        );
    }

    /**
     * @return non-empty-string
     */
    public function property(): string
    {
        return $this->property;
    }

    /**
     * @return ?non-empty-string
     */
    public function type(): ?string
    {
        return $this->type;
    }

    /**
     * @return ?enum-string
     */
    public function enumType(): ?string
    {
        return $this->enumType;
    }

    /**
     * Whether the field is the identifier of the entity (multiple
     * fields can have the `$id` attribute, forming a composite
     * identifier).
     */
    public function id(): bool
    {
        return false;
    }

    public function insertable(): bool
    {
        return $this->insertable;
    }

    public function updatable(): bool
    {
        return $this->updatable;
    }

    public function generated(): ?Generated
    {
        return $this->generated;
    }

    public function column(): Column
    {
        return $this->column;
    }
}
