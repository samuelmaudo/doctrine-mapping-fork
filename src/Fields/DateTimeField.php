<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Fields;

use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\Column;

class DateTimeField extends AbstractField
{
    public static function defaultType(): string
    {
        return Types::DATETIMETZ_IMMUTABLE;
    }

    /**
     * @param non-empty-string|null $name column name (defaults to the field name)
     * @param non-empty-string|null $definition SQL fragment that is used when generating the DDL for the column (non-portable)
     * @param bool $nullable whether the column is nullable (defaults to FALSE)
     * @param mixed $default default value to set for the column if no value is supplied
     * @param non-empty-string|null $comment comment of the column in the schema (might not be supported by all vendors)
     *
     * @throws DoctrineMappingException
     */
    public function withColumn(
        ?string $name = null,
        ?string $definition = null,
        bool $nullable = false,
        mixed $default = null,
        ?string $comment = null,
    ): self {
        return $this->withColumnObject(
            Column::of(
                field: $this,
                name: $name,
                definition: $definition,
                nullable: $nullable,
                default: $default,
                comment: $comment,
            ),
        );
    }
}
