<?php

declare(strict_types=1);

namespace Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Fields\FixedBinaryField;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FixedBinaryFieldTest extends TestCase
{
    public function testParentClass(): void
    {
        $field = FixedBinaryField::of('field');

        self::assertInstanceOf(AbstractField::class, $field);
        self::assertNotInstanceOf(AbstractId::class, $field);
    }

    public function testDefaultType(): void
    {
        $field = FixedBinaryField::of('field');

        self::assertSame(Types::BINARY, $field->type());
    }

    public function testColumn(): void
    {
        $name = fake()->word();
        $definition = fake()->word();
        $unique = fake()->boolean();
        $nullable = fake()->boolean();
        $length = fake()->integerBetween(1);
        $default = fake()->word();
        $comment = fake()->sentence();

        $field = FixedBinaryField::of('field')->withColumn(
            name: $name,
            definition: $definition,
            unique: $unique,
            nullable: $nullable,
            length: $length,
            default: $default,
            comment: $comment,
        );

        $column = $field->column();

        self::assertSame($name, $column->name());
        self::assertSame($definition, $column->definition());
        self::assertSame($unique, $column->unique());
        self::assertSame($nullable, $column->nullable());
        self::assertSame($length, $column->length());
        self::assertSame($default, $column->default());
        self::assertSame($comment, $column->comment());

        self::assertTrue($column->fixed());

        self::assertNull($column->precision());
        self::assertNull($column->scale());
        self::assertNull($column->unsigned());
        self::assertNull($column->charset());
        self::assertNull($column->collation());
    }
}
