<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Fields\TextField;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class TextFieldTest extends TestCase
{
    public function testParentClass(): void
    {
        $field = TextField::of('field');

        self::assertInstanceOf(AbstractField::class, $field);
        self::assertNotInstanceOf(AbstractId::class, $field);
    }

    public function testDefaultType(): void
    {
        $field = TextField::of('field');

        self::assertSame(Types::TEXT, $field->type());
    }

    public function testColumn(): void
    {
        $name = \fake()->word();
        $definition = \fake()->word();
        $nullable = \fake()->boolean();
        $length = \fake()->positiveInteger();
        $default = \fake()->text();
        $charset = \fake()->word();
        $collation = \fake()->word();
        $comment = \fake()->sentence();

        $field = TextField::of('field')->withColumn(
            name: $name,
            definition: $definition,
            nullable: $nullable,
            length: $length,
            default: $default,
            charset: $charset,
            collation: $collation,
            comment: $comment,
        );

        $column = $field->column();

        self::assertSame($name, $column->name());
        self::assertSame($definition, $column->definition());
        self::assertSame($nullable, $column->nullable());
        self::assertSame($length, $column->length());
        self::assertSame($default, $column->default());
        self::assertSame($charset, $column->charset());
        self::assertSame($collation, $column->collation());
        self::assertSame($comment, $column->comment());

        self::assertFalse($column->unique());
        self::assertNull($column->precision());
        self::assertNull($column->scale());
        self::assertNull($column->unsigned());
        self::assertNull($column->fixed());
    }
}
