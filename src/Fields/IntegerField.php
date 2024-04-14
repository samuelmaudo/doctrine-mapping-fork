<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Fields;

use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\Column;

/**
 * @psalm-immutable
 */
class IntegerField extends AbstractField
{
    public static function defaultType(): string
    {
        return Types::INTEGER;
    }

    /**
     * @param ?non-empty-string $name Column name (defaults to the field name).
     * @param ?non-empty-string $definition SQL fragment that is used when generating the DDL for the column (non-portable).
     * @param bool $unique Whether a unique constraint should be generated for the column.
     * @param bool $nullable Whether the column is nullable (defaults to FALSE).
     * @param mixed $default Default value to set for the column if no value is supplied.
     * @param ?non-empty-string $comment Comment of the column in the schema (might not be supported by all vendors).
     *
     * @throws DoctrineMappingException
     */
    public function withColumn(
        ?string $name = null,
        ?string $definition = null,
        bool $unique = false,
        bool $nullable = false,
        mixed $default = null,
        ?string $comment = null,
    ): static {
        return $this->withColumnObject(
            Column::of(
                field: $this,
                name: $name,
                definition: $definition,
                unique: $unique,
                nullable: $nullable,
                default: $default,
                unsigned: false,
                comment: $comment,
            ),
        );
    }
}
