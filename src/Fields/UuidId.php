<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Fields;

use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Column;

/**
 * @psalm-immutable
 */
class UuidId extends AbstractId
{
    public static function defaultType(): string
    {
        return Types::GUID;
    }

    /**
     * @param ?non-empty-string $name Column name (defaults to the field name).
     * @param ?non-empty-string $definition SQL fragment that is used when generating the DDL for the column (non-portable).
     * @param ?non-empty-string $charset Charset of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server).
     * @param ?non-empty-string $collation Collation of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server).
     * @param ?non-empty-string $comment Comment of the column in the schema (might not be supported by all vendors).
     *
     * @throws DoctrineMappingException
     */
    public function withColumn(
        ?string $name = null,
        ?string $definition = null,
        ?string $charset = null,
        ?string $collation = null,
        ?string $comment = null,
    ): self {
        return $this->withColumnObject(
            Column::of(
                field: $this,
                name: $name,
                definition: $definition,
                length: 36,
                fixed: true,
                charset: $charset,
                collation: $collation,
                comment: $comment,
            ),
        );
    }
}
