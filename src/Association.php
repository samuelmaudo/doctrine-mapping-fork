<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Error;
use Hereldar\DoctrineMapping\Enums\Cascade;
use Hereldar\DoctrineMapping\Enums\Fetch;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionClass;

/**
 * @psalm-immutable
 */
abstract class Association extends AbstractAssociation
{
    protected ReflectionClass $targetEntity;

    public function targetEntity(): ReflectionClass
    {
        return $this->targetEntity;
    }

    /**
     * @return class-string
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
     * @return list<Cascade>
     *
     * @throws DoctrineMappingException
     */
    protected static function sanitizeCascade(
        string $associationName,
        ?array $options,
    ): array {
        if (null === $options) {
            return [];
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
        if (is_object($option)) {
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
