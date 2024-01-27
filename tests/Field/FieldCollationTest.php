<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\Field\Collation\DefinedCollation;
use Hereldar\DoctrineMapping\Tests\Field\Collation\EmptyCollation;
use Hereldar\DoctrineMapping\Tests\Field\Collation\UndefinedCollation;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldCollationTest extends TestCase
{
    public function testDefinedCollation(): void
    {
        $metadata = $this->loadClassMetadata(DefinedCollation::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['field']);
        self::assertSame('latin1_spanish_ci', $metadata->fieldMappings['field']['options']['collation']);
    }

    public function testUndefinedCollation(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedCollation::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['field']);
        self::assertNull($metadata->fieldMappings['field']['options']['collation']);
    }

    public function testEmptyCollation(): void
    {
        $this->expectException(MappingException::emptyCollation(EmptyCollation::class, 'field'));

        $this->loadClassMetadata(EmptyCollation::class);
    }
}
