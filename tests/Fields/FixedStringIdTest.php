<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Fields\FixedStringId;
use Hereldar\DoctrineMapping\Interfaces\FieldLike;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FixedStringIdTest extends TestCase
{
    public function testParentClass(): void
    {
        $field = FixedStringId::of('id');

        self::assertInstanceOf(FieldLike::class, $field);
        self::assertInstanceOf(AbstractId::class, $field);
    }

    public function testDefaultType(): void
    {
        $field = FixedStringId::of('id');

        self::assertSame(Types::STRING, $field->type());
    }

    public function testColumn(): void
    {
        $name = \fake()->word();
        $definition = \fake()->word();
        $length = \fake()->positiveInteger();
        $charset = \fake()->word();
        $collation = \fake()->word();
        $comment = \fake()->sentence();

        $field = FixedStringId::of('id')->withColumn(
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

        self::assertTrue($column->fixed());

        self::assertFalse($column->unique());
        self::assertFalse($column->nullable());
        self::assertNull($column->precision());
        self::assertNull($column->scale());
        self::assertNull($column->default());
        self::assertNull($column->unsigned());
    }
}
