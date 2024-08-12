<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Fields;

use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Column;

class IntegerId extends AbstractId
{
    public static function defaultType(): string
    {
        return Types::INTEGER;
    }

    /**
     * @param non-empty-string|null $name column name (defaults to the field name)
     * @param non-empty-string|null $definition SQL fragment that is used when generating the DDL for the column (non-portable)
     * @param non-empty-string|null $comment comment of the column in the schema (might not be supported by all vendors)
     *
     * @throws DoctrineMappingException
     */
    public function withColumn(
        ?string $name = null,
        ?string $definition = null,
        ?string $comment = null,
    ): static {
        return $this->withColumnObject(
            Column::of(
                field: $this,
                name: $name,
                definition: $definition,
                unsigned: false,
                comment: $comment,
            ),
        );
    }
}
