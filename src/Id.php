<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

/**
 * @psalm-immutable
 */
final class Id
{
    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $column
     * @param ?non-empty-string $type
     * @param ?positive-int $length
     */
    public static function of(
        string $property,
        ?string $column = null,
        ?string $type = null,
        ?int $length = null,
        ?bool $unsigned = null,
        ?bool $fixed = null,
    ): Field {
        return Field::of(
            property: $property,
            column: $column,
            type: $type,
            id: true,
            nullable: false,
            length: $length,
            unsigned: $unsigned,
            fixed: $fixed,
        );
    }
}
