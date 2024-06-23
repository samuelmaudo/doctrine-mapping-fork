<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Error;
use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Interfaces\FieldLike;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

/**
 * @psalm-immutable
 */
abstract class AbstractField implements FieldLike
{
    protected ?string $type;

    /**
     * @param non-empty-string $property
     * @param non-empty-string|null $type
     * @param enum-string|null $enumType
     */
    protected function __construct(
        protected string $property,
        ?string $type,
        protected ?string $enumType,
        protected bool $insertable,
        protected bool $updatable,
        protected ?Generated $generated,
        protected Column $column,
    ) {
        $this->type = $type ?? static::defaultType();
    }

    /**
     * @param non-empty-string $property name of the field in the entity
     * @param non-empty-string|null $type
     * @param enum-string|null $enumType
     * @param bool $insertable whether the field is insertable (defaults to TRUE)
     * @param bool $updatable whether the field is updatable (defaults to TRUE)
     * @param Generated|'NEVER'|'INSERT'|'ALWAYS'|int<0, 2>|null $generated whether a generated value should be retrieved from the database after INSERT or UPDATE
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
    ): static {
        self::validateProperty($property);
        self::validateType($type, $property);
        self::validateEnumType($enumType, $property);
        $generated = self::sanitizeGenerated($generated, $property);

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
     * @return non-empty-string|null
     */
    public static function defaultType(): ?string
    {
        return null;
    }

    protected static function validateProperty(string $property): void
    {
        if (!$property) {
            throw MappingException::emptyPropertyName();
        }
    }

    protected static function validateType(
        ?string $type,
        string $property,
    ): void {
        if ('' === $type) {
            throw MappingException::emptyType($property);
        }
    }

    protected static function validateEnumType(
        ?string $enumType,
        string $property,
    ): void {
        if ('' === $enumType) {
            throw MappingException::emptyEnumType($property);
        }
    }

    protected static function sanitizeGenerated(
        Generated|int|string|null $generated,
        string $property,
    ): ?Generated {
        if (null === $generated || \is_object($generated)) {
            return $generated;
        }

        try {
            return Generated::from($generated);
        } catch (Error) {
            throw MappingException::invalidGenerationMode(
                $property,
                $generated,
            );
        }
    }

    /**
     * @return non-empty-string
     */
    public function property(): string
    {
        return $this->property;
    }

    /**
     * @return non-empty-string|null
     */
    public function type(): ?string
    {
        return $this->type;
    }

    /**
     * @return enum-string|null
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

    protected function withColumnObject(Column $column): static
    {
        return new static(
            $this->property,
            $this->type,
            $this->enumType,
            $this->insertable,
            $this->updatable,
            $this->generated,
            $column,
        );
    }
}
