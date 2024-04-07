<?php

declare(strict_types=1);

namespace Hereldar\DoctrineMapping\Tests\Field;

use Doctrine\Persistence\Mapping\MappingException as DoctrineMappingException;
use Hereldar\DoctrineMapping\Tests\Field\Generated\AlwaysGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\InsertGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\InvalidGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\NeverGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\NullGenerated;
use Hereldar\DoctrineMapping\Tests\Field\Generated\UndefinedGenerated;
use Hereldar\DoctrineMapping\Tests\TestCase;

final class FieldGeneratedTest extends TestCase
{
    public function testNeverGenerated(): void
    {
        $metadata = $this->loadClassMetadata(NeverGenerated::class);

        self::assertArrayNotHasKey('generated', $metadata->fieldMappings['id']);
        self::assertArrayNotHasKey('generated', $metadata->fieldMappings['field']);
    }

    public function testInsertGenerated(): void
    {
        $metadata = $this->loadClassMetadata(InsertGenerated::class);

        self::assertSame(1, $metadata->fieldMappings['id']['generated']);
        self::assertSame(1, $metadata->fieldMappings['field']['generated']);
    }

    public function testAlwaysGenerated(): void
    {
        $metadata = $this->loadClassMetadata(AlwaysGenerated::class);

        self::assertSame(2, $metadata->fieldMappings['id']['generated']);
        self::assertSame(2, $metadata->fieldMappings['field']['generated']);
    }

    public function testNullGenerated(): void
    {
        $metadata = $this->loadClassMetadata(NullGenerated::class);

        self::assertNull($metadata->fieldMappings['field']['generated']);
    }

    public function testUndefinedGenerated(): void
    {
        $metadata = $this->loadClassMetadata(UndefinedGenerated::class);

        self::assertNull($metadata->fieldMappings['field']['generated']);
    }

    public function testInvalidGenerated(): void
    {
        $this->expectException(DoctrineMappingException::class);
        $this->expectExceptionMessage("Invalid file 'InvalidGenerated.orm.php': Invalid generation mode 'UNKNOWN' for field 'field'");

        $this->loadClassMetadata(InvalidGenerated::class);
    }
}
