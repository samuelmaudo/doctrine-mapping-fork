<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Hereldar\DoctrineMapping\Exceptions\MappingException;
use Hereldar\DoctrineMapping\Tests\Field\Charset\DefinedCharset;
use Hereldar\DoctrineMapping\Tests\Field\Charset\EmptyCharset;
use Hereldar\DoctrineMapping\Tests\Field\Charset\UndefinedCharset;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldCharsetTest extends TestCase
{
    public function testDefinedCharset(): void
    {
        $metadata = $this->loadClassMetadata(DefinedCharset::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['field']);
        self::assertSame('gb2312', $metadata->fieldMappings['field']['options']['charset']);
    }

    public function testUndefinedCharset(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedCharset::class);

        self::assertArrayHasKey('field', $metadata->fieldMappings);
        self::assertArrayHasKey('options', $metadata->fieldMappings['field']);
        self::assertNull($metadata->fieldMappings['field']['options']['charset']);
    }

    public function testEmptyCharset(): void
    {
        $this->expectException(MappingException::emptyCharset(EmptyCharset::class, 'field'));

        $this->loadClassMetadata(EmptyCharset::class);
    }
}
