<?php

use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Column;
use Hereldar\DoctrineMapping\Entity;
use Hereldar\DoctrineMapping\Tests\Column\Nullable\NullableId;

/**
 * @internal
 */
final class TestNullableId extends AbstractId
{
    public function withColumn(bool $nullable = false): self
    {
        return new self(
            $this->property,
            $this->type,
            $this->enumType,
            $this->insertable,
            $this->updatable,
            $this->generated,
            Column::of(
                field: $this,
                nullable: $nullable,
            ),
            $this->strategy,
            $this->sequenceGenerator,
            $this->customIdGenerator,
        );
    }
}

return Entity::of(
    class: NullableId::class,
)->withFields(
    TestNullableId::of(property: 'id')->withColumn(nullable: true),
);
