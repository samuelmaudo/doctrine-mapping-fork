<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\Field;

/**
 * @psalm-immutable
 */
final class BooleanField
{
    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $column
     */
    public static function of(
        string $property,
        ?string $column = null,
        ?bool $nullable = null,
        bool $insertable = true,
        bool $updatable = true,
    ): Field {
        return Field::of(
            property: $property,
            column: $column,
            type: Types::BOOLEAN,
            nullable: $nullable,
            insertable: $insertable,
            updatable: $updatable,
        );
    }
}
