<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Interfaces\AssociationLike;
use Hereldar\DoctrineMapping\Internals\Collection;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;
use ReflectionException;
use ReflectionNamedType;
use ReflectionProperty;

/**
 * @extends Collection<Association>
 */
final class Associations extends Collection
{
    /**
     * @throws DoctrineMappingException
     */
    public static function of(
        AbstractEntity $entity,
        AssociationLike ...$associations,
    ): self {
        $associations = \array_values($associations);

        self::ensureAssociationsAreNotDuplicated($entity, $associations);
        $properties = self::ensurePropertiesExist($entity, $associations);
        $associations = self::completeIncompleteAssociations($entity, $associations, $properties);

        return new self($associations);
    }

    public static function empty(): self
    {
        return new self([]);
    }

    /**
     * @param list<AssociationLike> $associations
     *
     * @throws DoctrineMappingException
     */
    private static function ensureAssociationsAreNotDuplicated(
        AbstractEntity $entity,
        array $associations,
    ): void {
        $properties = [];

        foreach ($associations as $association) {
            $property = $association->property();

            if (isset($properties[$property])) {
                throw MappingException::duplicateProperty(
                    $entity->classShortName(),
                    $property,
                );
            }

            $properties[$property] = true;
        }
    }

    /**
     * @param list<AssociationLike> $associations
     *
     * @return list<ReflectionProperty>
     *
     * @throws DoctrineMappingException
     */
    private static function ensurePropertiesExist(
        AbstractEntity $entity,
        array $associations,
    ): array {
        $class = $entity->class();
        $properties = [];

        foreach ($associations as $association) {
            $propertyName = $association->property();
            try {
                $properties[] = $class->getProperty($propertyName);
            } catch (ReflectionException) {
                throw MappingException::propertyNotFound(
                    $entity->classShortName(),
                    $propertyName,
                );
            }
        }

        return $properties;
    }

    /**
     * @param list<AssociationLike> $associations
     * @param list<ReflectionProperty> $properties
     *
     * @return list<Association>
     *
     * @throws DoctrineMappingException
     */
    private static function completeIncompleteAssociations(
        AbstractEntity $entity,
        array $associations,
        array $properties,
    ): array {
        $completeAssociations = [];

        foreach ($associations as $i => $association) {
            if ($association instanceof IncompleteAssociation) {
                $property = $properties[$i];
                $propertyType = $property->getType();

                if (!$propertyType instanceof ReflectionNamedType) {
                    throw MappingException::missingTargetEntity(
                        $entity->classShortName(),
                        $property->name,
                    );
                }

                $association = $association->withTargetEntity(
                    /** @psalm-suppress ArgumentTypeCoercion */
                    /** @phpstan-ignore argument.type */
                    $propertyType->getName()
                );
            }
            $completeAssociations[] = $association;
        }

        /** @var list<Association> */
        return $completeAssociations;
    }
}
