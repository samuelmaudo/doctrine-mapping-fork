<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\Field;

/**
 * @psalm-immutable
 */
final class UnsignedSmallIntegerField
{
    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $column
     */
    public static function of(
        string $property,
        ?string $column = null,
        bool $id = false,
        bool $unique = false,
        ?bool $nullable = null,
        bool $insertable = true,
        bool $updatable = true,
    ): Field {
        return Field::of(
            property: $property,
            column: $column,
            type: Types::SMALLINT,
            id: $id,
            unique: $unique,
            nullable: $nullable,
            insertable: $insertable,
            updatable: $updatable,
            unsigned: true,
        );
    }
}
