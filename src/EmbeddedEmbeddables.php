<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Collection;

/**
 * @extends Collection<Embeddable>
 */
final class EmbeddedEmbeddables extends Collection
{
    public function __construct(Embeddable ...$embeddables)
    {
        $this->items = $embeddables;
    }

    /**
     * @throws DoctrineMappingException
     */
    public static function of(Fields $fields): self
    {
        $embeddables = [];

        foreach ($fields as $field) {
            if ($field instanceof Embedded
                && null !== $field->class()) {
                $embeddables[] = Embeddable
                    ::of($field->class())
                    ->withFields(...$field->fields())
                ;
            }
        }

        return new self(...$embeddables);
    }

    public static function empty(): self
    {
        return new self();
    }
}
