<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Error;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\CustomIdGeneratorResolver;

/**
 * @psalm-immutable
 */
final class Field
{
    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $type
     * @param ?enum-string $enumType
     * @param ?class-string<AbstractIdGenerator> $customIdGenerator
     */
    private function __construct(
        private string $property,
        private ?string $type,
        private ?string $enumType,
        private bool $id,
        private bool $insertable,
        private bool $updatable,
        private ?Generated $generated,
        private Strategy $strategy,
        private Column $column,
        private ?SequenceGenerator $sequenceGenerator,
        private ?string $customIdGenerator,
    ) {}

    /**
     * @param non-empty-string $property Name of the field in the Entity.
     * @param ?non-empty-string $type
     * @param ?enum-string $enumType
     * @param bool $id Marks the field as the identifier of the entity (multiple fields can have the `$id` attribute, forming a composite identifier).
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
        bool $id = false,
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

        return new self(
            $property,
            $type,
            $enumType,
            $id,
            $insertable,
            $updatable,
            $generated,
            Strategy::from(Strategy::None),
            Column::empty(),
            null,
            null,
        );
    }

    /**
     * @param ?non-empty-string $name Column name (defaults to the field name).
     * @param ?non-empty-string $definition SQL fragment that is used when generating the DDL for the column (non-portable).
     * @param bool $unique Whether a unique constraint should be generated for the column.
     * @param ?bool $nullable Whether the column is nullable (defaults to FALSE).
     * @param ?positive-int $length Database length of the column.
     * @param ?non-negative-int $precision Maximum number of digits that can be stored (applies only for `decimal` columns).
     * @param ?non-negative-int $scale Number of digits to the right of the decimal point (applies only for `decimal` columns and must not be greater than the precision).
     * @param mixed $default Default value to set for the column if no value is supplied.
     * @param ?bool $unsigned Whether the column can store only non-negative integers (applies only for `integer` columns and might not be supported by all vendors).
     * @param ?bool $fixed Whether the column length is fixed or varying (applies only for `string` and `binary` columns, and might not be supported by all vendors).
     * @param ?non-empty-string $charset Charset of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server).
     * @param ?non-empty-string $collation Collation of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server).
     * @param ?non-empty-string $comment Comment of the column in the schema (might not be supported by all vendors).
     *
     * @return $this
     *
     * @throws DoctrineMappingException
     */
    public function withColumn(
        ?string $name = null,
        ?string $definition = null,
        bool $unique = false,
        ?bool $nullable = null,
        ?int $length = null,
        ?int $precision = null,
        ?int $scale = null,
        mixed $default = null,
        ?bool $unsigned = null,
        ?bool $fixed = null,
        ?string $charset = null,
        ?string $collation = null,
        ?string $comment = null,
    ): self {
        return new self(
            $this->property,
            $this->type,
            $this->enumType,
            $this->id,
            $this->insertable,
            $this->updatable,
            $this->generated,
            $this->strategy,
            Column::of(
                $this,
                $name,
                $definition,
                $unique,
                $nullable,
                $length,
                $precision,
                $scale,
                $default,
                $unsigned,
                $fixed,
                $charset,
                $collation,
                $comment,
            ),
            $this->sequenceGenerator,
            $this->customIdGenerator,
        );
    }

    /**
     * Specifies which strategy is used for identifier generation for
     * a field which `$id` property  is true.
     *
     * @param Strategy|'AUTO'|'SEQUENCE'|'IDENTITY'|'NONE'|'CUSTOM'|int<1, 7> $strategy How the value should be generated (defaults to 'AUTO').
     *
     * @return $this
     *
     * @throws DoctrineMappingException
     */
    public function withGeneratedValue(
        Strategy|string|int $strategy = Strategy::Auto,
    ): self {
        if (!is_object($strategy)) {
            try {
                $strategy = Strategy::from($strategy);
            } catch (Error) {
                throw MappingException::invalidGenerationStrategy(
                    $this->property,
                    $strategy,
                );
            }
        }

        return new self(
            $this->property,
            $this->type,
            $this->enumType,
            $this->id,
            $this->insertable,
            $this->updatable,
            $this->generated,
            $strategy,
            $this->column,
            $this->sequenceGenerator,
            $this->customIdGenerator,
        );
    }

    /**
     * Specifies details about the sequence used for identifier
     * generation, such as the increment size and initial values of
     * the sequence.
     *
     * @param ?non-empty-string $sequenceName Name of the sequence.
     * @param positive-int $allocationSize How much the sequence is increased when a new value is fetched. A value larger than 1 allows optimization for scenarios where you create more than one new entity per request. Defaults to 1.
     * @param positive-int $initialValue Where the sequence starts. Defaults to 1.
     *
     * @return $this
     *
     * @throws DoctrineMappingException
     */
    public function withSequenceGenerator(
        ?string $sequenceName,
        int $allocationSize = 1,
        int $initialValue = 1,
    ): self {
        return new self(
            $this->property,
            $this->type,
            $this->enumType,
            $this->id,
            $this->insertable,
            $this->updatable,
            $this->generated,
            (Strategy::None === $this->strategy->value())
                ? Strategy::from(Strategy::Sequence)
                : $this->strategy,
            $this->column,
            SequenceGenerator::of(
                $this,
                $sequenceName,
                $allocationSize,
                $initialValue,
            ),
            $this->customIdGenerator,
        );
    }

    /**
     * Specifies a user-provided class to generate identifiers. Such
     * class must extend `\Doctrine\ORM\Id\AbstractIdGenerator`.
     *
     * @param class-string<AbstractIdGenerator> $class Name of the class.
     *
     * @return $this
     *
     * @throws DoctrineMappingException
     */
    public function withCustomIdGenerator(
        string $class,
    ): self {
        return new self(
            $this->property,
            $this->type,
            $this->enumType,
            $this->id,
            $this->insertable,
            $this->updatable,
            $this->generated,
            (Strategy::None === $this->strategy->value())
                ? Strategy::from(Strategy::Custom)
                : $this->strategy,
            $this->column,
            $this->sequenceGenerator,
            CustomIdGeneratorResolver::resolve($class)?->name,
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

    public function id(): bool
    {
        return $this->id;
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

    public function strategy(): Strategy
    {
        return $this->strategy;
    }

    public function column(): Column
    {
        return $this->column;
    }

    public function sequenceGenerator(): ?SequenceGenerator
    {
        return $this->sequenceGenerator;
    }

    /**
     * @return ?class-string<AbstractIdGenerator>
     */
    public function customIdGenerator(): ?string
    {
        return $this->customIdGenerator;
    }
}
