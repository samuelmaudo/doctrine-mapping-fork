<?php

declare(strict_types=1);

namespace Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Fields\UuidId;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class UuidIdTest extends TestCase
{
    public function testParentClass(): void
    {
        $field = UuidId::of('id');

        self::assertInstanceOf(AbstractField::class, $field);
        self::assertInstanceOf(AbstractId::class, $field);
    }

    public function testDefaultType(): void
    {
        $field = UuidId::of('id');

        self::assertSame(Types::GUID, $field->type());
    }

    public function testColumn(): void
    {
        $name = fake()->word();
        $definition = fake()->word();
        $charset = fake()->word();
        $collation = fake()->word();
        $comment = fake()->sentence();

        $field = UuidId::of('id')->withColumn(
            name: $name,
            definition: $definition,
            charset: $charset,
            collation: $collation,
            comment: $comment,
        );

        $column = $field->column();

        self::assertSame($name, $column->name());
        self::assertSame($definition, $column->definition());
        self::assertSame($charset, $column->charset());
        self::assertSame($collation, $column->collation());
        self::assertSame($comment, $column->comment());

        self::assertSame(36, $column->length());
        self::assertTrue($column->fixed());

        self::assertFalse($column->unique());
        self::assertFalse($column->nullable());
        self::assertNull($column->precision());
        self::assertNull($column->scale());
        self::assertNull($column->default());
        self::assertNull($column->unsigned());
    }
}
