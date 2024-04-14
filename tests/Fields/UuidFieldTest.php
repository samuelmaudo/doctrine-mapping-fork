<?php

declare(strict_types=1);

namespace Fields;

use Doctrine\DBAL\Types\Types;
use Hereldar\DoctrineMapping\AbstractField;
use Hereldar\DoctrineMapping\AbstractId;
use Hereldar\DoctrineMapping\Fields\UuidField;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class UuidFieldTest extends TestCase
{
    public function testParentClass(): void
    {
        $field = UuidField::of('field');

        self::assertInstanceOf(AbstractField::class, $field);
        self::assertNotInstanceOf(AbstractId::class, $field);
    }

    public function testDefaultType(): void
    {
        $field = UuidField::of('field');

        self::assertSame(Types::GUID, $field->type());
    }

    public function testColumn(): void
    {
        $name = fake()->word();
        $definition = fake()->word();
        $unique = fake()->boolean();
        $nullable = fake()->boolean();
        $default = fake()->uuid();
        $charset = fake()->word();
        $collation = fake()->word();
        $comment = fake()->sentence();

        $field = UuidField::of('field')->withColumn(
            name: $name,
            definition: $definition,
            unique: $unique,
            nullable: $nullable,
            default: $default,
            charset: $charset,
            collation: $collation,
            comment: $comment,
        );

        $column = $field->column();

        self::assertSame($name, $column->name());
        self::assertSame($definition, $column->definition());
        self::assertSame($unique, $column->unique());
        self::assertSame($nullable, $column->nullable());
        self::assertSame($default, $column->default());
        self::assertSame($charset, $column->charset());
        self::assertSame($collation, $column->collation());
        self::assertSame($comment, $column->comment());

        self::assertSame(36, $column->length());
        self::assertTrue($column->fixed());

        self::assertNull($column->precision());
        self::assertNull($column->scale());
        self::assertNull($column->unsigned());
    }
}
