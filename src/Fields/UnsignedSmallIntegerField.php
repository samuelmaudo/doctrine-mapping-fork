<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\Field;
use Hereldar\DoctrineMapping\Id;

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
        bool $primaryKey = false,
        ?bool $nullable = null,
        bool $insertable = true,
        bool $updatable = true,
    ): Field|Id {
        if ($primaryKey) {
            return Id::of(
                property: $property,
                column: $column,
                type: Types::SMALLINT,
                unsigned: true,
            );
        }

        return Field::of(
            property: $property,
            column: $column,
            type: Types::SMALLINT,
            nullable: $nullable,
            insertable: $insertable,
            updatable: $updatable,
            unsigned: true,
        );
    }
}
