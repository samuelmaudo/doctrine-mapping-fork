<?php

declare(strict_types=1);

namespace Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Fields\StringId;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class StringIdTest extends TestCase
{
    public function testParentClass(): void
    {
        $field = StringId::of('id');

        self::assertInstanceOf(AbstractField::class, $field);
        self::assertInstanceOf(AbstractId::class, $field);
    }

    public function testDefaultType(): void
    {
        $field = StringId::of('id');

        self::assertSame(Types::STRING, $field->type());
    }

    public function testColumn(): void
    {
        $name = fake()->word();
        $definition = fake()->word();
        $length = fake()->integerBetween(1);
        $charset = fake()->word();
        $collation = fake()->word();
        $comment = fake()->sentence();

        $field = StringId::of('id')->withColumn(
            name: $name,
            definition: $definition,
            length: $length,
            charset: $charset,
            collation: $collation,
            comment: $comment,
        );

        $column = $field->column();

        self::assertSame($name, $column->name());
        self::assertSame($definition, $column->definition());
        self::assertSame($length, $column->length());
        self::assertSame($charset, $column->charset());
        self::assertSame($collation, $column->collation());
        self::assertSame($comment, $column->comment());

        self::assertFalse($column->fixed());

        self::assertFalse($column->unique());
        self::assertFalse($column->nullable());
        self::assertNull($column->precision());
        self::assertNull($column->scale());
        self::assertNull($column->default());
        self::assertNull($column->unsigned());
    }
}
