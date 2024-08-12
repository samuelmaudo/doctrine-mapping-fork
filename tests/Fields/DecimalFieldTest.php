<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Fields\DecimalField;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class DecimalFieldTest extends TestCase
{
    public function testParentClass(): void
    {
        $field = DecimalField::of('field');

        self::assertInstanceOf(AbstractField::class, $field);
        self::assertNotInstanceOf(AbstractId::class, $field);
    }

    public function testDefaultType(): void
    {
        $field = DecimalField::of('field');

        self::assertSame(Types::DECIMAL, $field->type());
    }

    public function testColumn(): void
    {
        $name = \fake()->word();
        $definition = \fake()->word();
        $nullable = \fake()->boolean();
        /** @var positive-int $precision */
        $precision = \fake()->integerBetween(10, 20);
        /** @var positive-int $scale */
        $scale = \fake()->integerBetween(1, 6);
        $default = \fake()->float();
        $comment = \fake()->sentence();

        $field = DecimalField::of('field')->withColumn(
            name: $name,
            definition: $definition,
            nullable: $nullable,
            precision: $precision,
            scale: $scale,
            default: $default,
            comment: $comment,
        );

        $column = $field->column();

        self::assertSame($name, $column->name());
        self::assertSame($definition, $column->definition());
        self::assertSame($nullable, $column->nullable());
        self::assertSame($precision, $column->precision());
        self::assertSame($scale, $column->scale());
        self::assertSame($default, $column->default());
        self::assertSame($comment, $column->comment());

        self::assertFalse($column->unique());
        self::assertNull($column->length());
        self::assertNull($column->unsigned());
        self::assertNull($column->fixed());
        self::assertNull($column->charset());
        self::assertNull($column->collation());
    }
}
