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
    protected Strategy $strategy;

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
        ?Strategy $strategy = null,
        protected ?SequenceGenerator $sequenceGenerator = null,
        protected ?string $customIdGenerator = null,
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

        $this->strategy = $strategy ?? Strategy::from(Strategy::None);
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
     * @return $this
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
            (Strategy::None === $this->strategy->value())
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
     * @return $this
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
            (Strategy::None === $this->strategy->value())
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
}
