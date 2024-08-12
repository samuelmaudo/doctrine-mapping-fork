<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Interfaces\AssociationLike;
use Hereldar\DoctrineMapping\Internals\Exceptions\MappingException;

final class OrderBy
{
    /**
     * @param non-empty-array<non-empty-string,'ASC'|'DESC'> $value
     */
    private function __construct(
        private readonly array $value,
    ) {}

    /**
     * @param non-empty-array<non-empty-string,'ASC'|'DESC'> $value
     *
     * @throws DoctrineMappingException
     */
    public static function of(
        AssociationLike $association,
        array $value,
    ): self {
        foreach ($value as $field => $direction) {
            if (!\is_string($field) || '' === $field) {
                throw MappingException::invalidOrderByField(
                    $association->property(),
                    $field,
                );
            }
            if ('ASC' !== $direction && 'DESC' !== $direction) {
                throw MappingException::invalidOrderByDirection(
                    $association->property(),
                    $direction,
                );
            }
        }

        return new self($value);
    }

    /**
     * @return non-empty-array<non-empty-string,'ASC'|'DESC'>
     */
    public function value(): array
    {
        return $this->value;
    }
}
