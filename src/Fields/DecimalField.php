<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\Field;

/**
 * @psalm-immutable
 */
final class DecimalField
{
    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $column
     * @param ?non-negative-int $precision
     * @param ?non-negative-int $scale
     */
    public static function of(
        string $property,
        ?string $column = null,
        ?bool $nullable = null,
        bool $insertable = true,
        bool $updatable = true,
        ?int $precision = null,
        ?int $scale = null,
    ): Field {
        return Field::of(
            property: $property,
            column: $column,
            type: Types::DECIMAL,
            nullable: $nullable,
            insertable: $insertable,
            updatable: $updatable,
            precision: $precision,
            scale: $scale,
        );
    }
}
