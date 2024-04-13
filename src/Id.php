<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;

/**
 * @psalm-immutable
 */
final class Id extends AbstractId
{
    /**
     * @param ?non-empty-string $name Column name (defaults to the field name).
     * @param ?non-empty-string $definition SQL fragment that is used when generating the DDL for the column (non-portable).
     * @param ?positive-int $length Database length of the column.
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
        ?int $length = null,
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
                field: $this,
                name: $name,
                definition: $definition,
                length: $length,
                unsigned: $unsigned,
                fixed: $fixed,
                charset: $charset,
                collation: $collation,
                comment: $comment,
            ),
            $this->strategy,
            $this->sequenceGenerator,
            $this->customIdGenerator,
        );
    }
}
