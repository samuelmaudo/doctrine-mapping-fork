<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Error;
use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Interfaces\FieldLike;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\CustomIdGeneratorResolver;

abstract class AbstractId implements FieldLike
{
    /** @var non-empty-string|null */
    protected readonly ?string $type;

    /**
     * @param non-empty-string $property
     * @param non-empty-string|null $type
     * @param enum-string|null $enumType
     * @param class-string<AbstractIdGenerator>|null $customIdGenerator
     */
    final protected function __construct(
        protected readonly string $property,
        ?string $type,
        protected readonly ?string $enumType,
        protected readonly bool $insertable,
        protected readonly bool $updatable,
        protected readonly ?Generated $generated,
        protected readonly Column $column,
        protected readonly Strategy $strategy,
        protected readonly ?SequenceGenerator $sequenceGenerator,
        protected readonly ?string $customIdGenerator,
    ) {
        $this->type = $type ?? static::defaultType();
    }

    /**
     * @param non-empty-string $property name of the field in the Entity
     * @param non-empty-string|null $type
     * @param enum-string|null $enumType
     * @param bool $insertable whether the field is insertable (defaults to TRUE)
     * @param bool $updatable whether the field is updatable (defaults to TRUE)
     * @param Generated|'NEVER'|'INSERT'|'ALWAYS'|null $generated whether a generated value should be retrieved from the database after INSERT or UPDATE
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        string $property,
        ?string $type = null,
        ?string $enumType = null,
        bool $insertable = true,
        bool $updatable = true,
        Generated|string|null $generated = null,
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
            Strategy::None,
            null,
            null,
        );
    }

    /**
     * @return non-empty-string|null
     */
    public static function defaultType(): ?string
    {
        return null;
    }

    /**
     * Specifies which strategy is used for identifier generation for
     * a field which `$id` property  is true.
     *
     * @param Strategy|'AUTO'|'SEQUENCE'|'IDENTITY'|'NONE'|'CUSTOM' $strategy how the value should be generated (defaults to 'AUTO')
     *
     * @throws DoctrineMappingException
     */
    public function withGeneratedValue(
        Strategy|string $strategy = Strategy::Auto,
    ): static {
        if (!$strategy instanceof Strategy) {
            try {
                $strategy = Strategy::from($strategy);
            } catch (Error) {
                throw MappingException::invalidGenerationStrategy(
                    $this->property,
                    $strategy,
                );
            }
        }

        return new static(
            $this->property,
            $this->type,
            $this->enumType,
            $this->insertable,
            $this->updatable,
            $this->generated,
            $this->column,
            $strategy,
            $this->sequenceGenerator,
            $this->customIdGenerator,
        );
    }

    /**
     * Specifies details about the sequence used for identifier
     * generation, such as the increment size and initial values of
     * the sequence.
     *
     * @param non-empty-string|null $sequenceName name of the sequence
     * @param positive-int $allocationSize How much the sequence is increased when a new value is fetched. A value larger than 1 allows optimization for scenarios where you create more than one new entity per request. Defaults to 1.
     * @param positive-int $initialValue Where the sequence starts. Defaults to 1.
     *
     * @throws DoctrineMappingException
     */
    public function withSequenceGenerator(
        ?string $sequenceName,
        int $allocationSize = 1,
        int $initialValue = 1,
    ): static {
        return new static(
            $this->property,
            $this->type,
            $this->enumType,
            $this->insertable,
            $this->updatable,
            $this->generated,
            $this->column,
            (Strategy::None === $this->strategy)
                ? Strategy::Sequence
                : $this->strategy,
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
     * @param class-string<AbstractIdGenerator> $class name of the class
     *
     * @throws DoctrineMappingException
     */
    public function withCustomIdGenerator(
        string $class,
    ): static {
        return new static(
            $this->property,
            $this->type,
            $this->enumType,
            $this->insertable,
            $this->updatable,
            $this->generated,
            $this->column,
            (Strategy::None === $this->strategy)
                ? Strategy::Custom
                : $this->strategy,
            $this->sequenceGenerator,
            CustomIdGeneratorResolver::resolve($class)->name,
        );
    }

    /**
     * @psalm-assert non-empty-string $property
     */
    protected static function validateProperty(string $property): void
    {
        if ('' === $property) {
            throw MappingException::emptyPropertyName();
        }
    }

    /**
     * @psalm-assert non-empty-string|null $type
     */
    protected static function validateType(
        ?string $type,
        string $property,
    ): void {
        if ('' === $type) {
            throw MappingException::emptyType($property);
        }
    }

    /**
     * @psalm-assert non-empty-string|null $enumType
     */
    protected static function validateEnumType(
        ?string $enumType,
        string $property,
    ): void {
        if ('' === $enumType) {
            throw MappingException::emptyEnumType($property);
        }
    }

    protected static function sanitizeGenerated(
        Generated|string|null $generated,
        string $property,
    ): ?Generated {
        if (null === $generated || $generated instanceof Generated) {
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
        return true;
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

    public function strategy(): Strategy
    {
        return $this->strategy;
    }

    public function sequenceGenerator(): ?SequenceGenerator
    {
        return $this->sequenceGenerator;
    }

    /**
     * @return class-string<AbstractIdGenerator>|null
     */
    public function customIdGenerator(): ?string
    {
        return $this->customIdGenerator;
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
            $this->strategy,
            $this->sequenceGenerator,
            $this->customIdGenerator,
        );
    }
}
