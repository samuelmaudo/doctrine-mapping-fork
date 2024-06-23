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
class StringField extends AbstractField
{
    public static function defaultType(): string
    {
        return Types::STRING;
    }

    /**
     * @param non-empty-string|null $name column name (defaults to the field name)
     * @param non-empty-string|null $definition SQL fragment that is used when generating the DDL for the column (non-portable)
     * @param bool $unique whether a unique constraint should be generated for the column
     * @param bool $nullable whether the column is nullable (defaults to FALSE)
     * @param positive-int|null $length database length of the column
     * @param mixed $default default value to set for the column if no value is supplied
     * @param non-empty-string|null $charset charset of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server)
     * @param non-empty-string|null $collation collation of the column (only supported by MySQL, PostgreSQL, SQLite and SQL Server)
     * @param non-empty-string|null $comment comment of the column in the schema (might not be supported by all vendors)
     *
     * @throws DoctrineMappingException
     */
    public function withColumn(
        ?string $name = null,
        ?string $definition = null,
        bool $unique = false,
        bool $nullable = false,
        ?int $length = null,
        mixed $default = null,
        ?string $charset = null,
        ?string $collation = null,
        ?string $comment = null,
    ): self {
        return $this->withColumnObject(
            Column::of(
                field: $this,
                name: $name,
                definition: $definition,
                unique: $unique,
                nullable: $nullable,
                length: $length,
                default: $default,
                fixed: false,
                charset: $charset,
                collation: $collation,
                comment: $comment,
            ),
        );
    }
}
