<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\SequenceGenerator;
use Hereldar\DoctrineMapping\Internals\Elements\ResolvedSequenceGenerator;
use ReflectionProperty;

/**
 * @internal
 */
final class SequenceGeneratorResolver
{
    /**
     * @throws MappingException
     */
    public static function resolve(
        ReflectionProperty $property,
        ?SequenceGenerator $sequenceGenerator,
    ): ?ResolvedSequenceGenerator {
        if ($sequenceGenerator === null) {
            return null;
        }

        if ($sequenceGenerator->sequenceName() === '') {
            throw MappingException::emptySequenceName(
                $property->class,
                $property->name,
            );
        }

        if ($sequenceGenerator->allocationSize() < 1) {
            throw MappingException::nonPositiveAllocationSize(
                $property->class,
                $property->name,
            );
        }

        if ($sequenceGenerator->initialValue() < 1) {
            throw MappingException::nonPositiveInitialValue(
                $property->class,
                $property->name,
            );
        }

        return new ResolvedSequenceGenerator(
            $sequenceGenerator->sequenceName(),
            $sequenceGenerator->allocationSize(),
            $sequenceGenerator->initialValue(),
        );
    }
}
