<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;

/**
 * @psalm-immutable
 */
class Id extends AbstractId
{
    /**
     * @param non-empty-string|null $name column name (defaults to the field name)
     * @param non-empty-string|null $definition SQL fragment that is used when generating the DDL for the column (non-portable)
     * @param positive-int|null $length database length of the column
     * @param bool|null $unsigned whether the column can store only non-negative integers (applies only for `integer` columns and might not be supported by all vendors)
     * @param bool|null $fixed whether the column length is fixed or varying (applies only for `string` and `binary` columns, and might not be supported by all vendors)
     * @param non-empty-string|null $charset charset of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server)
     * @param non-empty-string|null $collation collation of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server)
     * @param non-empty-string|null $comment comment of the column in the schema (might not be supported by all vendors)
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
        return $this->withColumnObject(
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
        );
    }
}
