<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Collection;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

/**
 * @extends Collection<UniqueConstraint>
 */
final class UniqueConstraints extends Collection
{
    public function __construct(UniqueConstraint ...$constraints)
    {
        $this->items = $constraints;
    }

    /**
     * @throws DoctrineMappingException
     */
    public static function of(
        Entity|MappedSuperclass $entity,
        UniqueConstraint ...$constraints,
    ): self {
        $names = [];

        foreach ($constraints as $constraint) {
            $name = $constraint->name();
            if (null === $name) {
                continue;
            }
            if (isset($names[$name])) {
                throw MappingException::duplicateUniqueConstraintName(
                    $entity->classSortName(),
                    $name,
                );
            }
            $names[$name] = true;
        }

        return new self(...$constraints);
    }

    public static function empty(): self
    {
        return new self();
    }
}
