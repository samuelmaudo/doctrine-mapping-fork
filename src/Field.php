<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;

/**
 * @psalm-immutable
 */
final class Field extends AbstractField
{
    /**
     * @param ?non-empty-string $name Column name (defaults to the field name).
     * @param ?non-empty-string $definition SQL fragment that is used when generating the DDL for the column (non-portable).
     * @param bool $unique Whether a unique constraint should be generated for the column.
     * @param bool $nullable Whether the column is nullable (defaults to FALSE).
     * @param ?positive-int $length Database length of the column.
     * @param ?non-negative-int $precision Maximum number of digits that can be stored (applies only for `decimal` columns).
     * @param ?non-negative-int $scale Number of digits to the right of the decimal point (applies only for `decimal` columns and must not be greater than the precision).
     * @param mixed $default Default value to set for the column if no value is supplied.
     * @param ?bool $unsigned Whether the column can store only non-negative integers (applies only for `integer` columns and might not be supported by all vendors).
     * @param ?bool $fixed Whether the column length is fixed or varying (applies only for `string` and `binary` columns, and might not be supported by all vendors).
     * @param ?non-empty-string $charset Charset of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server).
     * @param ?non-empty-string $collation Collation of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server).
     * @param ?non-empty-string $comment Comment of the column in the schema (might not be supported by all vendors).
     *
     * @return $this
     *
     * @throws DoctrineMappingException
     */
    public function withColumn(
        ?string $name = null,
        ?string $definition = null,
        bool $unique = false,
        bool $nullable = false,
        ?int $length = null,
        ?int $precision = null,
        ?int $scale = null,
        mixed $default = null,
        ?bool $unsigned = null,
        ?bool $fixed = null,
        ?string $charset = null,
        ?string $collation = null,
        ?string $comment = null,
    ): self {
        return new self(
            $this->property,
            $this->type,
            $this->enumType,
            $this->insertable,
            $this->updatable,
            $this->generated,
            Column::of(
                $this,
                $name,
                $definition,
                $unique,
                $nullable,
                $length,
                $precision,
                $scale,
                $default,
                $unsigned,
                $fixed,
                $charset,
                $collation,
                $comment,
            ),
        );
    }
}
