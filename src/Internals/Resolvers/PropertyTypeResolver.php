<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Internals\Resolvers;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\Exceptions\MappingException;
use ReflectionNamedType;
use ReflectionProperty;

/**
 * @internal
 */
final class PropertyTypeResolver
{
    /**
     * @throws MappingException
     *
     * @return non-empty-string
     */
    public static function resolve(
        ReflectionProperty $property,
        ?string $fieldType,
    ): string {
        if ($fieldType) {
            return $fieldType;
        }

        $propertyType = $property->getType();

        if (!$propertyType instanceof ReflectionNamedType) {
            throw MappingException::propertyTypeNotFound(
                $property->class,
                $property->name,
            );
        }

        return match ($propertyType->getName())  {
            'array' => Types::JSON,
            'bool', 'false', 'true' => Types::BOOLEAN,
            'float' => Types::FLOAT,
            'int' => Types::INTEGER,
            'string' => Types::STRING,
            'DateInterval' => Types::DATEINTERVAL,
            'DateTime' => Types::DATETIME_MUTABLE,
            'DateTimeImmutable' => Types::DATETIME_IMMUTABLE,
            default => throw MappingException::propertyTypeNotFound(
                $property->class,
                $property->name,
            ),
        };
    }
}
