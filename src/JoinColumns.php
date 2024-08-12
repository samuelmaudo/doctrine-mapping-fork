<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Interfaces\AssociationLike;
use Hereldar\DoctrineMapping\Internals\Collection;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

/**
 * @extends Collection<JoinColumn>
 */
final class JoinColumns extends Collection
{
    /**
     * @throws DoctrineMappingException
     */
    public static function of(
        AssociationLike $association,
        JoinColumn ...$columns,
    ): self {
        $names = [];

        foreach ($columns as $column) {
            $name = $column->name();
            if (null === $name) {
                continue;
            }
            if (isset($names[$name])) {
                throw MappingException::duplicateJoinColumnName(
                    $association->property(),
                    $name,
                );
            }
            $names[$name] = true;
        }

        return new self(\array_values($columns));
    }

    public static function empty(): self
    {
        return new self([]);
    }
}
