<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Collection;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

/**
 * @extends Collection<Index>
 */
final class Indexes extends Collection
{
    /**
     * @throws DoctrineMappingException
     */
    public static function of(
        AbstractEntity $entity,
        Index ...$indexes,
    ): self {
        $names = [];

        foreach ($indexes as $index) {
            $name = $index->name();
            if (null === $name) {
                continue;
            }
            if (isset($names[$name])) {
                throw MappingException::duplicateIndexName(
                    $entity->classShortName(),
                    $name,
                );
            }
            $names[$name] = true;
        }

        return new self(\array_values($indexes));
    }

    public static function empty(): self
    {
        return new self([]);
    }
}
