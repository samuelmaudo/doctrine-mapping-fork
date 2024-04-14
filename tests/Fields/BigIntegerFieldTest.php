<?php

declare(strict_types=1);

namespace Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Fields\BigIntegerField;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class BigIntegerFieldTest extends TestCase
{
    public function testParentClass(): void
    {
        $field = BigIntegerField::of('field');

        self::assertInstanceOf(AbstractField::class, $field);
        self::assertNotInstanceOf(AbstractId::class, $field);
    }

    public function testDefaultType(): void
    {
        $field = BigIntegerField::of('field');

        self::assertSame(Types::BIGINT, $field->type());
    }

    public function testColumn(): void
    {
        $name = fake()->word();
        $definition = fake()->word();
        $unique = fake()->boolean();
        $nullable = fake()->boolean();
        $default = fake()->integerBetween();
        $comment = fake()->sentence();

        $field = BigIntegerField::of('field')->withColumn(
            name: $name,
            definition: $definition,
            unique: $unique,
            nullable: $nullable,
            default: $default,
            comment: $comment,
        );

        $column = $field->column();

        self::assertSame($name, $column->name());
        self::assertSame($definition, $column->definition());
        self::assertSame($unique, $column->unique());
        self::assertSame($nullable, $column->nullable());
        self::assertSame($default, $column->default());
        self::assertSame($comment, $column->comment());

        self::assertFalse($column->unsigned());

        self::assertNull($column->length());
        self::assertNull($column->precision());
        self::assertNull($column->scale());
        self::assertNull($column->fixed());
        self::assertNull($column->charset());
        self::assertNull($column->collation());
    }
}
