<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Error;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\Enums\Fetch;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionClass;

abstract class Association extends AbstractAssociation
{
    /**
     * @param non-empty-string $property
     * @phpstan-param ReflectionClass<object> $targetEntity
     * @param list<Cascade> $cascade
     */
    protected function __construct(
        protected readonly string $property,
        protected readonly ReflectionClass $targetEntity,
        protected readonly array $cascade,
        protected readonly Fetch $fetch,
    ) {}

    /**
     * @phpstan-return ReflectionClass<object>
     */
    public function targetEntity(): ReflectionClass
    {
        return $this->targetEntity;
    }

    /**
     * @return class-string
     * @psalm-return class-string
     * @phpstan-return class-string<object>
     */
    public function targetEntityName(): string
    {
        return $this->targetEntity->name;
    }

    /**
     * @return non-empty-string
     */
    public function targetEntityShortName(): string
    {
        /** @var non-empty-string */
        return $this->targetEntity->getShortName();
    }

    /**
     * @throws DoctrineMappingException
     *
     * @psalm-assert non-empty-string $associationName
     */
    protected static function validateProperty(string $associationName): void
    {
        if ('' === $associationName) {
            throw MappingException::emptyPropertyName();
        }
    }

    /**
     * @phpstan-param ReflectionClass<object>|null $targetEntity
     *
     * @throws DoctrineMappingException
     *
     * @psalm-assert non-empty-string|null $mappedBy
     */
    protected static function validateMappedBy(
        string $associationName,
        ?ReflectionClass $targetEntity,
        ?string $mappedBy,
    ): void {
        if (null === $mappedBy) {
            return;
        }

        if ('' === $mappedBy) {
            throw MappingException::emptyMappedByAttribute(
                $associationName,
            );
        }

        if (null === $targetEntity) {
            return;
        }

        if (!$targetEntity->hasProperty($mappedBy)) {
            throw MappingException::invalidMappedByAttribute(
                $targetEntity->getShortName(),
                $mappedBy,
            );
        }
    }

    /**
     * @phpstan-param ReflectionClass<object>|null $targetEntity
     *
     * @throws DoctrineMappingException
     *
     * @psalm-assert non-empty-string|null $inversedBy
     */
    protected static function validateInversedBy(
        string $associationName,
        ?ReflectionClass $targetEntity,
        ?string $inversedBy,
    ): void {
        if (null === $inversedBy) {
            return;
        }

        if ('' === $inversedBy) {
            throw MappingException::emptyInversedByAttribute(
                $associationName,
            );
        }

        if (null === $targetEntity) {
            return;
        }

        if (!$targetEntity->hasProperty($inversedBy)) {
            throw MappingException::invalidInversedByAttribute(
                $targetEntity->getShortName(),
                $inversedBy,
            );
        }
    }

    /**
     * @phpstan-param ReflectionClass<object>|null $targetEntity
     *
     * @throws DoctrineMappingException
     *
     * @psalm-assert non-empty-string|null $indexBy
     */
    protected static function validateIndexBy(
        string $associationName,
        ?ReflectionClass $targetEntity,
        ?string $indexBy,
    ): void {
        if (null === $indexBy) {
            return;
        }

        if ('' === $indexBy) {
            throw MappingException::emptyIndexByAttribute(
                $associationName,
            );
        }

        if (null === $targetEntity) {
            return;
        }

        if (!$targetEntity->hasProperty($indexBy)) {
            throw MappingException::invalidIndexByAttribute(
                $targetEntity->getShortName(),
                $indexBy,
            );
        }
    }

    /**
     * @param list<Cascade|string> $options
     *
     * @return list<Cascade>
     *
     * @throws DoctrineMappingException
     */
    protected static function sanitizeCascade(
        string $associationName,
        array $options,
    ): array {
        if (0 === \count($options)) {
            return $options;
        }

        $sanitizedOptions = [];

        foreach ($options as $option) {
            if ($option instanceof Cascade) {
                $sanitizedOptions[] = $option;
                continue;
            }

            try {
                $sanitizedOptions[] = Cascade::from($option);
            } catch (Error) {
                throw MappingException::invalidCascadeOption(
                    $associationName,
                    $option,
                );
            }
        }

        return $sanitizedOptions;
    }

    /**
     * @throws DoctrineMappingException
     */
    protected static function sanitizeFetch(
        string $associationName,
        Fetch|string $option,
    ): Fetch {
        if ($option instanceof Fetch) {
            return $option;
        }

        try {
            return Fetch::from($option);
        } catch (Error) {
            throw MappingException::invalidFetchOption(
                $associationName,
                $option,
            );
        }
    }
}
