<?php

declare(strict_types=1);

namespace Fields;

use DateTimeZone;
use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Fields\DateTimeField;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class DateTimeFieldTest extends TestCase
{
    public function testParentClass(): void
    {
        $field = DateTimeField::of('field');

        self::assertInstanceOf(AbstractField::class, $field);
        self::assertNotInstanceOf(AbstractId::class, $field);
    }

    public function testDefaultType(): void
    {
        $field = DateTimeField::of('field');

        self::assertSame(Types::DATETIMETZ_IMMUTABLE, $field->type());
    }

    public function testColumn(): void
    {
        $name = fake()->word();
        $definition = fake()->word();
        $nullable = fake()->boolean();
        $default = fake()->dateTime()->setTimezone(
            new DateTimeZone(fake()->timezone())
        );
        $comment = fake()->sentence();

        $field = DateTimeField::of('field')->withColumn(
            name: $name,
            definition: $definition,
            nullable: $nullable,
            default: $default,
            comment: $comment,
        );

        $column = $field->column();

        self::assertSame($name, $column->name());
        self::assertSame($definition, $column->definition());
        self::assertSame($nullable, $column->nullable());
        self::assertSame($default, $column->default());
        self::assertSame($comment, $column->comment());

        self::assertFalse($column->unique());
        self::assertNull($column->length());
        self::assertNull($column->precision());
        self::assertNull($column->scale());
        self::assertNull($column->unsigned());
        self::assertNull($column->fixed());
        self::assertNull($column->charset());
        self::assertNull($column->collation());
    }
}
