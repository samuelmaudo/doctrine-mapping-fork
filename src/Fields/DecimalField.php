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
class DecimalField extends AbstractField
{
    public static function defaultType(): string
    {
        return Types::DECIMAL;
    }

    /**
     * @param non-empty-string|null $name column name (defaults to the field name)
     * @param non-empty-string|null $definition SQL fragment that is used when generating the DDL for the column (non-portable)
     * @param bool $nullable whether the column is nullable (defaults to FALSE)
     * @param non-negative-int|null $precision maximum number of digits that can be stored (applies only for `decimal` columns)
     * @param non-negative-int|null $scale number of digits to the right of the decimal point (applies only for `decimal` columns and must not be greater than the precision)
     * @param mixed $default default value to set for the column if no value is supplied
     * @param non-empty-string|null $comment comment of the column in the schema (might not be supported by all vendors)
     *
     * @throws DoctrineMappingException
     */
    public function withColumn(
        ?string $name = null,
        ?string $definition = null,
        bool $nullable = false,
        ?int $precision = null,
        ?int $scale = null,
        mixed $default = null,
        ?string $comment = null,
    ): static {
        return $this->withColumnObject(
            Column::of(
                field: $this,
                name: $name,
                definition: $definition,
                nullable: $nullable,
                precision: $precision,
                scale: $scale,
                default: $default,
                comment: $comment,
            ),
        );
    }
}
