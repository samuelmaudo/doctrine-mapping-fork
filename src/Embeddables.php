<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Internals\Collection;

/**
 * @extends Collection<Embeddable>
 */
final class Embeddables extends Collection
{
    /**
     * @throws DoctrineMappingException
     */
    public static function fromFields(Fields $fields): self
    {
        $embeddables = [];

        foreach ($fields as $field) {
            if (!$field instanceof Embedded) {
                continue;
            }
            $embeddedFields = $field->fields();
            if (!$embeddedFields) {
                continue;
            }
            $embeddable = Embeddable
                ::of($field->class())
                ->withFields(...$embeddedFields)
            ;
            \array_push(
                $embeddables,
                $embeddable,
                ...$embeddable->embeddedEmbeddables(),
            );
        }

        return new self($embeddables);
    }

    public static function empty(): self
    {
        return new self([]);
    }
}
