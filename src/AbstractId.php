<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Error;
use Hereldar\DoctrineMapping\Enums\Generated;
use Hereldar\DoctrineMapping\Enums\Strategy;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Internals\Resolvers\CustomIdGeneratorResolver;

/**
 * @psalm-immutable
 */
abstract class AbstractId extends AbstractField
{
    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $type
     * @param ?enum-string $enumType
     * @param ?class-string<AbstractIdGenerator> $customIdGenerator
     */
    protected function __construct(
        string $property,
        ?string $type,
        ?string $enumType,
        bool $insertable,
        bool $updatable,
        ?Generated $generated,
        Column $column,
        protected Strategy $strategy,
        protected ?SequenceGenerator $sequenceGenerator,
        protected ?string $customIdGenerator,
    ) {
        parent::__construct(
            $property,
            $type,
            $enumType,
            $insertable,
            $updatable,
            $generated,
            $column,
        );
    }

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
            Strategy::from(Strategy::None),
            null,
            null,
        );
    }

    /**
     * Specifies which strategy is used for identifier generation for
     * a field which `$id` property  is true.
     *
     * @param Strategy|'AUTO'|'SEQUENCE'|'IDENTITY'|'NONE'|'CUSTOM'|int<1, 7> $strategy How the value should be generated (defaults to 'AUTO').
     *
     * @throws DoctrineMappingException
     */
    public function withGeneratedValue(
        Strategy|string|int $strategy = Strategy::Auto,
    ): static {
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
     * @param ?non-empty-string $sequenceName Name of the sequence.
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
            (Strategy::None === $this->strategy->value)
                ? Strategy::from(Strategy::Sequence)
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
     * @param class-string<AbstractIdGenerator> $class Name of the class.
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
            (Strategy::None === $this->strategy->value)
                ? Strategy::from(Strategy::Custom)
                : $this->strategy,
            $this->sequenceGenerator,
            CustomIdGeneratorResolver::resolve($class)?->name,
        );
    }

    public function id(): bool
    {
        return true;
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
     * @return ?class-string<AbstractIdGenerator>
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
