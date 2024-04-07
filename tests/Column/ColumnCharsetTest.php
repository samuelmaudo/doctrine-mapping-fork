<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Column;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Column\Charset\DefinedCharset;
use Hereldar\DoctrineMapping\Tests\Column\Charset\EmptyCharset;
use Hereldar\DoctrineMapping\Tests\Column\Charset\UndefinedCharset;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class ColumnCharsetTest extends TestCase
{
    public function testDefinedCharset(): void
    {
        $metadata = $this->loadClassMetadata(DefinedCharset::class);

        self::assertSame('gb2312', $metadata->fieldMappings['field']['options']['charset']);
    }

    public function testUndefinedCharset(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedCharset::class);

        self::assertNull($metadata->fieldMappings['field']['options']['charset']);
    }

    public function testEmptyCharset(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'EmptyCharset.orm.php': Empty charset for field 'field'");

        $this->loadClassMetadata(EmptyCharset::class);
    }
}
