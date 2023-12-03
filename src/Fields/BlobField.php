<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\Field;

/**
 * @psalm-immutable
 */
final class BlobField
{
    /**
     * @param non-empty-string $property
     * @param ?non-empty-string $column
     * @param ?positive-int $length
     */
    public static function of(
        string $property,
        ?string $column = null,
        ?bool $nullable = null,
        bool $insertable = true,
        bool $updatable = true,
        ?int $length = null,
    ): Field {
        return Field::of(
            property: $property,
            column: $column,
            type: Types::BLOB,
            nullable: $nullable,
            insertable: $insertable,
            updatable: $updatable,
            length: $length,
        );
    }
}
